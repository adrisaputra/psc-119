<?php

namespace App\Http\Controllers;

use App\Models\Complaint;   //nama model
use App\Models\Category;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Handling;   //nama model
use App\Models\SwitchOfficer;   //nama model
use App\Models\Officer;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

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
        $complaint->save();
		
        $officer = Officer::where('unit_id',$request->unit_id)->first();
        $handling = new Handling();
		$handling->complaint_id = $uuid;
		$handling->user_id = $officer->user_id;
        $handling->save();
		
        activity()->log('Tambah Data Aduan');
		return redirect('/process_complaint')->with('status','Data Tersimpan');
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
        $unit = Unit::get();
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
            }
        }else if($request->segment(1)=="process_complaint"){
            $view=view('admin.complaint.detail', compact('title','complaint','category','get_unit','officer','handling','switch_officer'));
        }else if($request->segment(1)=="accept_complaint"){
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
        
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();

        if($complaint->report_type=="complaint"){
            
            $complaint->fill($request->all());
            $complaint->status = "process";
            $complaint->save();
            
            $officer = Officer::where('unit_id',$request->unit_id)->first();
            $handling = Handling::where('complaint_id',$complaint->id)->first();

            $handling->status = NULL;
            $handling->user_id = $officer->user_id;
            $handling->save();

            activity()->log('Proses Data Aduan dengan ID = '.$complaint->id);
            return redirect('/process_complaint')->with('status', 'Data Berhasil Diproses');

        } else if($complaint->report_type=="emergency"){
            
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
            $handling = Handling::where('complaint_id',$complaint->id)->first();

            $handling->status = NULL;
            $handling->user_id = $officer->user_id;
            $handling->save();

            activity()->log('Proses Data Emergency dengan ID = '.$complaint->id);
            return redirect('/process_complaint')->with('status', 'Data Berhasil Diproses');
        }
        
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
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'request')
                                        ->orWhere('status', 'process')
                                        ->orWhere('status', 'dispatch')
                                        ->orWhere('status', 'accept');
                            })
                        ->count();
        } else if($request->segment(2)=="request"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'request');
                            })
                        ->count();
        } else if($request->segment(2)=="process"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'process')
                                ->orWhere('status', 'dispatch');
                            })
                        ->count();
        } else if($request->segment(2)=="accept"){
            $complaint = Complaint::where(function($query) {
                                $query->where('status', 'accept');
                            })
                        ->count();
        }
       
		if($complaint>0){
			echo "<span class='badge badge pill red float-right mr-10'>".$complaint."</span>";
		}
    }
}
