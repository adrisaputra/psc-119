<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;   //nama model
use App\Models\Handling;   //nama model
use App\Models\SwitchOfficer;   //nama model
use App\Models\Officer;   //nama model
use App\Models\User;   //nama model
use App\Models\Notification;   //nama model
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

class HandlingController extends BaseController
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

        $handling = Complaint::whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->whereHas('handling', function ($query){
                        $query->where('status', NULL)
                            ->orWhere('status', 'accept');
                    })->orderBy('id','DESC')->get();
        return $this->sendResponse($handling, 'Data Dispatch', $request->lang);
    }

    public function detail(Request $request)
    {
        
        $user = User::where('api_token', $request->header('token'))->first();   

        $handling = Complaint::where('id',$request->id)
                    ->whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->orderBy('id','DESC')->get();
        return $this->sendResponse($handling, 'Detail Dispatch', $request->lang);
    }

    public function last_emergency_accept(Request $request)
    {
        
        $user = User::where('api_token', $request->header('token'))->first();   

        $handling = Complaint::whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->whereHas('handling', function ($query){
                        $query->where('status', 'accept');
                            // ->orWhere('status', 'done');
                    })->orderBy('id','DESC')->limit(1)->get();
        return $this->sendResponse($handling, 'Data Aduan terakhir Yang Ditangani', $request->lang);
    }

    
    ## Simpan Data
    public function store(Request $request, $status)
    {
        
        if($status=='accept'){
            $validator = Validator::make($request->all(), [
                'coordinate_officer' => 'required'
            ]);

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }

        } elseif($status=='reject'){
            $validator = Validator::make($request->all(), [
                'description' => 'required'
            ]);

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }

        } else if($status=='done'){
            $validator = Validator::make($request->all(), [
                'diagnosis' => 'required',
                'handling' => 'required',
                'description' => 'required',
                'handling_status' => 'required',
                'reference_place' => 'required_if:handling_status,refer'
            ]); 

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }
        }
        
        

        if($status=='accept'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->status = 'accept';
            $complaint->coordinate_officer = $request->coordinate_officer;
            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'accept';
            $handling->response_time = date('Y-m-d H:i:s');
            $handling->save();

            $officer = Officer::where('user_id',$handling->user_id)->first();
            // $officer->status = 'available';
            $officer->save();
            
            $notification = new Notification();
            $notification->email = $complaint->user->email;
            $notification->message = "Petugas menuju Ke lokasi anda, Harap Tunggu";
            $notification->save();

            $this->notif_accept($complaint->user->email);
            
            return response([
                'status' => true,
                'message' => 'Data Aduan Diterima',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        } else if($status=='reject'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->status = 'dispatch';
            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'reject';
            $handling->save();

            $officer = Officer::where('user_id',$handling->user_id)->first();
            $officer->status = 'available';
            $officer->save();
            
            $switch_officer = new SwitchOfficer;
            $switch_officer->complaint_id = $request->id;
            $switch_officer->description = $request->description;
            $switch_officer->unit_id = $complaint->unit_id;
            $switch_officer->save();

            return response([
                'status' => true,
                'message' => 'Data Aduan Ditolak',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        } else if($status=='done'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->description = $request->description;
            $complaint->coordinate_officer = $request->coordinate_officer;
            $complaint->handling_status = $request->handling_status;
            if($request->handling_status == 'refer'){
                $complaint->reference_place = $request->reference_place;
            }
            $complaint->status = 'done';
            
            if($request->photo_citizen){
                $image = $request->photo_citizen;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(40) . '.png';
                $complaint->photo_citizen = $imageName;
                Storage::disk('image_done')->put($imageName, base64_decode($image));
            }
           
            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'done';
            $handling->diagnosis = $request->diagnosis;
            $handling->handling = $request->handling;
            $handling->done_time = date('Y-m-d H:i:s');
            $handling->save();

            $officer = Officer::where('user_id',$handling->user_id)->first();
            $officer->status = 'available';
            $officer->save();
            
            return response([
                'status' => true,
                'message' => 'Data Aduan Selesai Diproses',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        }

        
    }

    public function update_position_officer(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $complaint = Complaint::where('id',$request->id)->first();
        $complaint->fill($request->all());
    	$complaint->save();

        return $this->sendResponse($complaint, 'Update Posisi Petugas', $request->lang);
    }

    public function notif_accept($email)
	{
		/* Kirim Pesan */
		$msg = array(
			'body'  => 'Petugas menuju Ke lokasi anda, Harap Tunggu',
			'title' => 'PSC-119 Kota Baubau',
		);

		$server_key = 'AAAAY7iO1dQ:APA91bFFwvftfyDKdsb24HLuuYB0S73a2o-H84eTzx5ha0Ys2H_xziYt_U_QAdQDtI51vJs5GQEw_0QnX_w-9p0t7DYlIRfpGBgrS9raUMIOLmW8X7pXeC8B5HpIrRkg0OtY1R9yJUUm';

		$url            = 'https://fcm.googleapis.com/fcm/send';
		$fields['to']           = '/topics/'.$email;
		$fields['notification'] = $msg;
		$headers        = array(
			'Content-Type:application/json',
			'Authorization:key=' . $server_key,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);

		// exit;
	}
    

}
