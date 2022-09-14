<?php

namespace App\Http\Controllers;

use App\Models\Category;   //nama model
use App\Models\Complaint;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ChartController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Grafik";
        $emergency = Complaint::where('report_type','emergency')->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $phone = Complaint::where('report_type','phone')->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $complaint = Complaint::where('report_type','complaint')->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $category = category::get();
        return view('admin.chart.index',compact('title','category','emergency','phone','complaint'));
    }

    ## Tampikan Data
    public function search(Request $request)
    {
        $title = "Grafik";
        $category_id = $request->get('category_id');

        $start_d = substr($request->date_start,0,2);
        $start_m = substr($request->date_start,3,2);
        $start_y = substr($request->date_start,6,4);
        $from = $start_y.'-'.$start_m.'-'.$start_d;

        $end_d = substr($request->date_end,0,2);
        $end_m = substr($request->date_end,3,2);
        $end_y = substr($request->date_end,6,4);
        $to = $end_y.'-'.$end_m.'-'.$end_d;

        $emergency = Complaint::where('report_type','emergency')->orderBy('id', 'DESC');
        
                    if($request->get('date_start') && $request->get('date_end')){
                        $emergency = $emergency->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('date_start')){
                        $emergency = $emergency->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('category_id')){
                        $emergency = $emergency->where(function ($query) use ($category_id) {
                            $query->where('category_id', $category_id);
                        });
                    }
                    $emergency = $emergency->count();

        $phone = Complaint::where('report_type','phone')->orderBy('id', 'DESC');
        
                    if($request->get('date_start') && $request->get('date_end')){
                        $phone = $phone->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('date_start')){
                        $phone = $phone->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('category_id')){
                        $phone = $phone->where(function ($query) use ($category_id) {
                            $query->where('category_id', $category_id);
                        });
                    }
                    $phone = $phone->count();
                    
        $complaint = Complaint::where('report_type','complaint')->orderBy('id', 'DESC');
        
                    if($request->get('date_start') && $request->get('date_end')){
                        $complaint = $complaint->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('date_start')){
                        $complaint = $complaint->where(function ($query) use ($from, $to) {
                            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
                        });
                    }
                    if($request->get('category_id')){
                        $complaint = $complaint->where(function ($query) use ($category_id) {
                            $query->where('category_id', $category_id);
                        });
                    }
                    $complaint = $complaint->count();
                    
        $category = category::get();
        return view('admin.chart.index',compact('title','category','emergency','phone','complaint'));
    }
}
