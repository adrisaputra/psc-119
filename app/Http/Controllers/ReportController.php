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

class ReportController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
     
     ## Tampikan Data
     public function index()
     {
         $title = "Laporan";
         $category = category::get();
         return view('admin.report.index',compact('title','category'));
     }
 
}
