<?php

namespace App\Http\Controllers;

use App\Models\Complaint;   //nama model
use App\Models\Category;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Handling;   //nama model
use App\Models\SwitchOfficer;   //nama model
use App\Models\Officer;   //nama model
use App\Models\Notification;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index(Request $request)
    {
        $title = "Laporan Masyarakat";

        $unit = Unit::get();

        if($request->segment(1)=="incoming_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'request')
                                            ->orWhere('status', 'dispatch');
                                    })
                                    // ->orwhereHas('handling', function ($query){
                                    //     $query->where('status', 'reject');
                                    // })
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        }else if($request->segment(1)=="process_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'process');
                                    })->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        }else if($request->segment(1)=="accept_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'accept');
                                    })->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        }else if($request->segment(1)=="reject_complaint") {
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'reject');
                                    })->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        } else if($request->segment(1)=="done_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'done');
                                    })->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);
        }

        return view('admin.complaint.index',compact('title','complaint','unit'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Laporan Masyarakat";
        $complaint = $request->get('search');
        if($request->segment(1)=="incoming_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'request')
                                            ->orWhere('status', 'dispatch');
                                    })
                                    // ->orwhereHas('handling', function ($query){
                                    //     $query->where('status', 'reject');
                                    // })
                                    ->where('name', 'LIKE', '%'.$complaint.'%')
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);
        }else if($request->segment(1)=="process_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'process');
                                    })
                                    ->where('name', 'LIKE', '%'.$complaint.'%')
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        }else if($request->segment(1)=="accept_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'accept');
                                    })
                                    ->where('name', 'LIKE', '%'.$complaint.'%')
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        }else if($request->segment(1)=="reject_complaint") {
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'reject');
                                    })
                                    ->where('name', 'LIKE', '%'.$complaint.'%')
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);

        } else if($request->segment(1)=="done_complaint"){
            $complaint = Complaint::where(function ($query){
                                        $query->where('status', 'done');
                                    })
                                    ->where('name', 'LIKE', '%'.$complaint.'%')
                                    ->orderBy('created_at','DESC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.complaint.index',compact('title','complaint'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Laporan Masyarakat";
        $category = Category::get();
        $unit = Unit::get();
        $lat = "-5.4856429306487176";
        $long = "122.58496969552637";
		$view=view('admin.complaint.create',compact('title','category','unit', 'lat', 'long'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $coordinate = $request->lat.',%20'.$request->long;
        $check_location = $this->get_city($coordinate);
		
        if (stripos($check_location, "Bau-Bau City") !== false || stripos($check_location, "Kota Bau-Bau") !== false) {
            
            $this->validate($request, [
                'name' => 'required',
                'phone_number' => 'numeric|required',
                'incident_area' => 'required',
                'summary' => 'required',
                'category_id' => 'required'
            ]);

            $uuid = Str::uuid()->toString();

            $complaint = new Complaint();
            $complaint->id = $uuid;
            $complaint->ticket_number = "SPGDT".date('YmdHis');
            $complaint->name = $request->name;
            $complaint->phone_number = $request->phone_number;
            $complaint->incident_area = $request->incident_area;
            $complaint->summary = $request->summary;
            $complaint->category_id = $request->category_id;
            $complaint->psc = 'Baubau';
            $complaint->status = 'process';
            $complaint->unit_id = $request->unit_id;
            $complaint->report_type = 'phone';
            $complaint->coordinate_citizen = $request->lat.', '.$request->long;
            $complaint->user_id = Auth::user()->id;
            $complaint->save();
            
            $officer = Officer::where('unit_id',$request->unit_id)->first();
            $handling = new Handling();
            $handling->complaint_id = $uuid;
            $handling->user_id = $officer->user_id;
            $handling->save();
            
            activity()->log('Tambah Data Aduan');
            return redirect('/process_complaint')->with('status','Data Tersimpan');
        } else {
            $array = explode(',', $check_location);
            return redirect('/incoming_complaint/create')->with('status2', 'Lokasi Berada Di Luar Kota Baubau ('.$array[1].' )');
        }
        
    }

    ## Tampilkan Form Edit
    public function edit($complaint)
    {
        $title = "Laporan Masyarakat";
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $category = Category::get();
        $unit = Unit::get();
        $view=view('admin.complaint.edit', compact('title','complaint','category','unit'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $complaint)
    {
        
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();

        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'numeric|required',
            'incident_area' => 'required',
            'summary' => 'required',
            'category_id' => 'required'
        ]);

        $complaint->fill($request->all());
		$complaint->coordinate_citizen = $request->lat.', '.$request->long;
    	$complaint->save();
		
        activity()->log('Ubah Data Aduan dengan ID = '.$complaint->id);
		return redirect('/incoming_complaint')->with('status', 'Data Berhasil Diubah');
    }

    ## Tampilkan Form Edit
    public function detail(Request $request, $complaint)
    {
        $title = "Laporan Masyarakat";
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $category = Category::get();
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
                    })->orderBy('distance','ASC')->get();
        } else {
            $unit = Unit::select("units.*")
                    ->whereHas('officer', function ($query) {
                        $query->where('status','available');
                    })->get();
        }
        
        $officer = Officer::where('unit_id',$complaint->unit_id)->first();
        $get_unit = Unit::where('id',$complaint->unit_id)->first();
        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $switch_officer = SwitchOfficer::where('complaint_id',$complaint->id)->get();
        $lat = "-5.4856429306487176";
        $long = "122.58496969552637";
        
        if($request->segment(1)=="incoming_complaint"){
            if($complaint->report_type=="complaint"){
                $view=view('admin.complaint.complaint_detail', compact('title','complaint','category','unit','get_unit','officer','handling','switch_officer'));
            } else if($complaint->report_type=="emergency"){
                $view=view('admin.complaint.emergency_detail', compact('title','complaint','category','unit','lat', 'long','get_unit','officer','handling','switch_officer'));
            }else if($complaint->report_type=="phone"){
                $view=view('admin.complaint.emergency_detail', compact('title','complaint','category','unit','lat', 'long','get_unit','officer','handling','switch_officer'));
            }
        }else if($request->segment(1)=="process_complaint"){
            $view=view('admin.complaint.detail', compact('title','complaint','category','get_unit','officer','handling','switch_officer'));
        }else if($request->segment(1)=="accept_complaint"){
            $view=view('admin.complaint.detail', compact('title','complaint','category','get_unit','officer','handling','switch_officer'));
        }else if($request->segment(1)=="reject_complaint"){
            $view=view('admin.complaint.detail', compact('title','complaint','category','get_unit','officer','handling','switch_officer'));
        }else if($request->segment(1)=="done_complaint"){
            $view=view('admin.complaint.detail', compact('title','complaint','category','get_unit','officer','handling','switch_officer'));
        }
        
        
        $view=$view->render();
        return $view;
    }

    ## Process Data
    public function process(Request $request, $complaint)
    {
        $coordinate = $request->lat.',%20'.$request->long;
        $check_location = $this->get_city($coordinate);
		
        if (stripos($check_location, "Bau-Bau City") !== false || stripos($check_location, "Kota Bau-Bau") !== false) {
           
            $complaint = Crypt::decrypt($complaint);
            $complaint = Complaint::where('id',$complaint)->first();

            if($complaint->report_type=="complaint"){
                
                $complaint->fill($request->all());
                $complaint->coordinate_citizen = $request->lat.', '.$request->long;
                $complaint->status = "process";
                $complaint->save();
                
                $officer = Officer::where('unit_id',$request->unit_id)->first();
                $officer->status = 'noavailable';
                $officer->save();

                $handling = Handling::where('complaint_id',$complaint->id)->first();
                $handling->status = NULL;
                $handling->user_id = $officer->user_id;
                $handling->save();

                $notification = new Notification();
                $notification->email = $officer->user->email;
                $notification->message = "Perhatian!! Anda mendapat penugasan kegawatdaruratan medis, Harap ditindaklanjuti";
                $notification->save();

                $this->notif_handling($officer->user->email);

                activity()->log('Proses Data Aduan dengan ID = '.$complaint->id);
                return redirect('/process_complaint')->with('status', 'Data Berhasil Diproses');

            } else if($complaint->report_type=="emergency" || $complaint->report_type=="phone"){
                
                $this->validate($request, [
                    'incident_area' => 'required',
                    'summary' => 'required',
                    'category_id' => 'required'
                ]);
        
                $complaint->fill($request->all());
                $complaint->coordinate_citizen = $request->lat.', '.$request->long;
                $complaint->status = "process";
                $complaint->save();
                
                $officer = Officer::where('unit_id',$request->unit_id)->first();
                $officer->status = 'noavailable';
                $officer->save();

                $handling = Handling::where('complaint_id',$complaint->id)->first();
                $handling->status = NULL;
                $handling->user_id = $officer->user_id;
                $handling->save();

                $notification = new Notification();
                $notification->email = $officer->user->email;
                $notification->message = "Perhatian!! Anda mendapat penugasan kegawatdaruratan medis, Harap ditindaklanjuti";
                $notification->save();

                $this->notif_handling($officer->user->email);

                activity()->log('Proses Data Emergency dengan ID = '.$complaint->id);
                return redirect('/process_complaint')->with('status', 'Data Berhasil Diproses');
            }
        } else {
            $array = explode(',', $check_location);
            return redirect('/incoming_complaint/detail/'.$complaint)->with('status2', 'Lokasi Berada Di Luar Kota Baubau ('.$array[1].' )');
        }
        
        
    }

    ## Edit Data
    public function reject(Request $request, $complaint)
    {
        
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();

        $complaint->fill($request->all());
        $complaint->status = 'reject';
        $complaint->reason = $request->reason;
    	$complaint->save();
		
        activity()->log('Ubah Data Aduan dengan ID = '.$complaint->id);
		return redirect('/incoming_complaint')->with('status', 'Data Berhasil Ditolak');
    }

    ## Hapus Data
    public function delete($complaint)
    {
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
    	$complaint->delete();

        activity()->log('Hapus Data Complaint dengan ID = '.$complaint->id);
        return redirect('/incoming_complaint')->with('status', 'Data Berhasil Dihapus');
    }

    
	## Jumlah Data
    public function count_data(Request $request)
    {
        if($request->segment(2)=="all"){
            // $complaint = Complaint::where(function($query) {
            //                     $query->where('status', 'request')
            //                             ->orWhere('status', 'process')
            //                             ->orWhere('status', 'dispatch')
            //                             ->orWhere('status', 'accept');
            //                 })
            //             ->count();
            $complaint1 = Complaint::where(function($query) {
                                $query->where('status', 'request');
                            })
                        ->count();
            $complaint2 = Complaint::where(function($query) {
                                $query->where('status', 'process')
                                ->orWhere('status', 'dispatch');
                            })
                        ->count();
            $complaint3 = Complaint::where(function($query) {
                                $query->where('status', 'accept');
                            })
                        ->count();
            $complaint = $complaint1 +$complaint2 +$complaint3;

        } else if($request->segment(2)=="request"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'request')
                                ->orWhere('status', 'dispatch');
                            })
                        ->count();
        } else if($request->segment(2)=="process"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'process');
                            })
                        ->count();
        } else if($request->segment(2)=="accept"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'accept');
                            })
                        ->count();
        }
       
		// if($complaint>0){
        //     if($request->segment(2)=="request"){
        //         echo "<span class='badge badge pill red float-right mr-10 pulse'>".$complaint."</span>";
        //     }else if($request->segment(2)=="all"){
        //         if($complaint1 > 0){
        //             echo "<span class='badge badge pill red float-right mr-10 pulse'>".$complaint."</span>";
        //         } else {
        //             echo "<span class='badge badge pill red float-right mr-10'>".$complaint."</span>";
        //         }
        //     } else {
        //         echo "<span class='badge badge pill red float-right mr-10'>".$complaint."</span>";
        //     }
		// }
        return $complaint;
    }

    public function notif_handling($email)
	{
		/* Kirim Pesan */
		$msg = array(
			'body'  => 'Perhatian!! Anda mendapat penugasan kegawatdaruratan medis, Harap ditindaklanjuti',
			'title' => 'PSC-119 Kota Baubau',
		);

		$server_key = 'AAAAnu1CPUM:APA91bF2BPxuE5hWeUxUsSoPy_Tr_dAa0FRlnVvpzeTq3Z7tDg6qt2EPJggIN6Op7RPq7hkIsuSZApELpe6seewA9Wt_lB-jjt7r1gXniFbsEhpvQcwMSIPYjEOb8NWPC9cpqGdHohVv';

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
        // $get_city  =  json_encode($data['results'][1]['address_components'][5]['long_name']);
        $get_city  = json_encode($data['plus_code']['compound_code']);
        // ## String Ke Array
        $city_name = json_decode($get_city, TRUE);
        return $city_name;    
     }
}
