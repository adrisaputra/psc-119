<?php

namespace App\Http\Controllers;

use App\Models\Complaint;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        $complaint = Complaint::whereDate('created_at', date('Y-m-d'))->count();
        $complaint_request = Complaint::whereDate('created_at', date('Y-m-d'))->where('status','request')->count();
        $complaint_done = Complaint::whereDate('created_at', date('Y-m-d'))->where('status','done')->count();
        $complaint_reject = Complaint::whereDate('created_at', date('Y-m-d'))->where('status','reject')->count();
        $emergency_button = Complaint::whereDate('created_at', date('Y-m-d'))->where('report_type','emergency')->count();
        $phone = Complaint::whereDate('created_at', date('Y-m-d'))->where('report_type','phone')->count();
        $request = Complaint::whereDate('created_at', date('Y-m-d'))->where('report_type','complaint')->count();
        return view('admin.beranda', compact('complaint','complaint_request','complaint_done','complaint_reject','emergency_button','phone','request'));
    }

}
