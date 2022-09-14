<?php

namespace App\Http\Controllers;

use App\Models\Complaint;   //nama model
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
        $complaint = Complaint::orderBy('id','DESC')->get();
        return view('admin.tracking.index',compact('title','complaint'));
    }

    ## Tampikan Data
    public function detail($complaint)
    {
        
        $title = "Detail Traking Lokasi";
        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        return view('admin.tracking.detail',compact('title','complaint'));
    }
}
