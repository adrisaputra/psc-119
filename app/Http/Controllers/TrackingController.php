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

class TrackingController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Traking Lokasi";
        $complaint = Complaint::whereNot('status','reject')->orderBy('id','DESC')->get();
        return view('admin.tracking.index',compact('title','complaint'));
    }

    ## Tampikan Data
    public function detail($complaint)
    {
        
        $title = "Detail Traking Lokasi";
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $category = Category::get();
        $unit = Officer::where('status','available')->get();
        $officer = Officer::where('unit_id',$complaint->unit_id)->first();
        $get_unit = Unit::where('id',$complaint->unit_id)->first();
        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $switch_officer = SwitchOfficer::where('complaint_id',$complaint->id)->get();
        return view('admin.tracking.detail',compact('title','complaint','category','unit','officer','get_unit','handling','switch_officer'));
    }
}
