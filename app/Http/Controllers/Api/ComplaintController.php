<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;   //nama model
use App\Models\Category;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Handling;   //nama model
use App\Models\User;   //nama model
use App\Models\Citizen;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Storage;
use Image;

class ComplaintController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if($this->confirmToken($request) == self::$INVALID_TOKEN){
                return $this->sendError('Token Invalid', ['error' => 'Token not pair in your account'], 401, $request->lang);
            }elseif($this->confirmToken($request) == self::$EXPIRED_TOKEN){
                return $this->sendError('Token Expired', ['error' => 'Your account token has expired'], 401, $request->lang);
            } 

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $complaint = Complaint::where('user_id',$user->id)
                    ->where(function ($query) {
                        $query->where('status', 'request')
                            ->orWhere('status', 'process')
                            ->orWhere('status', 'dispatch')
                            ->orWhere('status', 'accept');
                    })->orderBy('created_at','DESC')->first();

        if($complaint->status=="request"){
            $status = "Aduan Terkirim ke Petugas Call Center";
        }elseif($complaint->status=="process"){
            $status = "Sedang Konfirmasi ke Petugas Lapangan";
        }elseif($complaint->status=="dispatch"){
            $status = "Sedang Konfirmasi ke Petugas Lapangan";
        }elseif($complaint->status=="accept"){
            $status = "Petugas menuju Ke Lokasi Anda";
        }elseif($complaint->status=="reject"){
            $status = "Aduan Ditolak";
        }elseif($complaint->status=="done"){
            $status = "Aduan Selesai";
        }

        $resultData = array(
            'id'=>$complaint->id,
            'ticket_number'=>$complaint->ticket_number,
            'phone_number'=>$complaint->phone_number,
            'name'=>$complaint->name,
            'incident_area'=>$complaint->incident_area,
            'summary'=>$complaint->summary,
            'category_id'=>$complaint->category_id,
            'psc'=>$complaint->psc,
            'status'=>$status,
            'unit_id'=>$complaint->unit_id,
            'coordinate_citizen'=>$complaint->coordinate_citizen,
            'coordinate_officer'=>$complaint->coordinate_officer,
            'image'=>$complaint->image,
            'photo_citizen'=>$complaint->photo_citizen,
            // 'photo'=>url('/').'/upload/photo/'.$user->photo,
            'description'=>$complaint->description,
            'reason'=>$complaint->reason,
            'report_type'=>$complaint->report_type,
            'handling_status'=>$complaint->handling_status,
            'reference_place'=>$complaint->reference_place,
            'user_id'=>$complaint->user_id,
            'created_at'=>$complaint->created_at,
            'updated_at'=>$complaint->updated_at
        );

        return $this->sendResponse($resultData, 'Data Aduan', $request->lang);
    }

    ## Simpan Data
    public function store(Request $request, $report_type)
    {
        
        $user = User::where('api_token', $request->header('token'))->first();   
        
        $count = Complaint::where('user_id',$user->id)
                    ->where(function ($query) {
                        $query->where('status', 'request')
                            ->orWhere('status', 'process')
                            ->orWhere('status', 'dispatch')
                            ->orWhere('status', 'accept');
                    })->first();

        if($count){
            return $this->sendError('Gagal', ['error' => 'Maaf, Anda masih memiliki aduan !'], 401, $request->lang);
        } else {

            if($request->coordinate_citizen){
            
                $coordinate = str_replace(" ", "%20", $request->coordinate_citizen);
                $check_location = $this->get_city($coordinate);
                // echo  $check_location;
                if (stripos($check_location, "Kendari City") !== false || stripos($check_location, "Kota Kendari") !== false) {
                // if (stripos($check_location, "Bau-Bau City") !== false || stripos($check_location, "Kota Bau-Bau") !== false) {
                    $citizen = Citizen::where('user_id', $user->id)->first();   
    
                    if($report_type=='complaint'){
                        $validator = Validator::make($request->all(), [
                            'incident_area' => 'required',
                            'summary' => 'required',
                            'category_id' => 'required',
                            'coordinate_citizen' => 'required'
                        ]);
                        
                        // return message if validation not passed
                        if ($validator->fails()) {
                            return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
                        }
                    }
                    
                    $uuid = Str::uuid()->toString();
            
                    $complaint = new Complaint();
                    $complaint->id = $uuid;
                    $complaint->ticket_number = "SPGDT".date('YmdHis');
                    $complaint->name = $citizen->name;
                    $complaint->phone_number = $citizen->phone_number;
                    $complaint->incident_area = $request->incident_area;
                    $complaint->summary = $request->summary;
                    $complaint->category_id = $request->category_id;
                    $complaint->psc = 'Baubau';
                    $complaint->status = 'request';
                    $complaint->report_type = $report_type;
                    
                    if($request->image){
                        $image = $request->image;  // your base64 encoded
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = Str::random(40) . '.png';
                        $complaint->image = $imageName;
                        Storage::disk('image_citizen')->put($imageName, base64_decode($image));
                    }
            
                    $complaint->coordinate_citizen = $request->coordinate_citizen;
                    
                    $lat_long = explode(", ", $complaint->coordinate_citizen); 
                    if($complaint->coordinate_citizen){
                        $unit = Unit::select("units.*"
                                ,DB::raw("6371 * acos(cos(radians(" . $lat_long[0] . ")) 
                                * cos(radians(SUBSTRING_INDEX(coordinate, ',', 1))) 
                                * cos(radians(SUBSTRING_INDEX(coordinate, ',', -1)) - radians(" . $lat_long[1] . ")) 
                                + sin(radians(" .$lat_long[0]. ")) 
                                * sin(radians(SUBSTRING_INDEX(coordinate, ',', 1)))) AS distance"))
                                ->whereHas('officer', function ($query) {
                                    $query->where('status','available');
                                })->orderBy('distance','ASC')->first();
    
                        
                        $complaint->coordinate_officer = $unit->coordinate;
                    }
                    
                    $complaint->user_id = $user->id;
                    $complaint->save();
                    
                    $handling = new Handling();
                    $handling->complaint_id = $uuid;
                    $handling->save();
                    
                    return response([
                        'status' => true,
                        'message' => 'Data Aduan terkirim',
                        'data' => $complaint,
                    ], 200, array(), JSON_PRETTY_PRINT);
                } else {
                    $array = explode(',',$check_location);
                    return $this->sendError('Gagal', ['error' => 'Lokasi Berada Di Luar Kota Baubau ('.$array[1].' )'], 401, $request->lang);
                }
            } else {
                $citizen = Citizen::where('user_id', $user->id)->first();   
    
                if($report_type=='complaint'){
                    $validator = Validator::make($request->all(), [
                        'incident_area' => 'required',
                        'summary' => 'required',
                        'category_id' => 'required',
                        'coordinate_citizen' => 'required'
                    ]);
                    
                    // return message if validation not passed
                    if ($validator->fails()) {
                        return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
                    }
                }
                
                $uuid = Str::uuid()->toString();
        
                $complaint = new Complaint();
                $complaint->id = $uuid;
                $complaint->ticket_number = "SPGDT".date('YmdHis');
                $complaint->name = $citizen->name;
                $complaint->phone_number = $citizen->phone_number;
                $complaint->incident_area = $request->incident_area;
                $complaint->summary = $request->summary;
                $complaint->category_id = $request->category_id;
                $complaint->psc = 'Baubau';
                $complaint->status = 'request';
                $complaint->report_type = $report_type;
                 
                if($request->image){
                    $image = $request->image;  // your base64 encoded
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = Str::random(40) . '.png';
                    $complaint->image = $imageName;
                    Storage::disk('image_citizen')->put($imageName, base64_decode($image));
                }
        
                $complaint->coordinate_citizen = $request->coordinate_citizen;
                $complaint->user_id = $user->id;
                $complaint->save();
                
                $handling = new Handling();
                $handling->complaint_id = $uuid;
                $handling->save();
                
                return response([
                    'status' => true,
                    'message' => 'Data Aduan terkirim',
                    'data' => $complaint,
                ], 200, array(), JSON_PRETTY_PRINT);
            }
            
        }            
       
    }

    public function get_city($coordinate){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$coordinate.'&sensor=true&key=AIzaSyDk5azS8gZ2aDInOTqyPv7FmB5uBlu55RQ',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            ': '
        ),
        ));

        $response = curl_exec($curl);

        $data = json_decode($response, TRUE);
        // $get_city  = json_encode($data['results'][1]['address_components'][5]['long_name']);
        $get_city  = json_encode($data['plus_code']['compound_code']);
        // ## String Ke Array
        $city_name = json_decode($get_city, TRUE);
        return $city_name;    
     }
}
