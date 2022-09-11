<?php

namespace App\Http\Controllers;

use App\Models\Handling;   //nama model
use App\Models\Complaint;   //nama model
use App\Models\Officer;   //nama model
use App\Models\Menu;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class HandlingController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampilkan Form Edit
    public function edit($complaint)
    {
         $title = "Penanganan";
         
         $complaint = Crypt::decrypt($complaint);
         $complaint = Complaint::where('id',$complaint)->first();

         $handling = Handling::where('complaint_id',$complaint->id)->first();

         $view=view('admin.handling.edit', compact('title','complaint','handling'));
         $view=$view->render();
         return $view;
    }

    ## Edit Data
    public function update(Request $request, $complaint)
    {
       
         $complaint = Crypt::decrypt($complaint);
         $complaint = Complaint::where('id',$complaint)->first();
         
         $complaint->unit_id = $request->unit_id;
         $complaint->description = $request->description;
         $complaint->save();
         
         $officer = Officer::where('unit_id',$request->unit_id)->first();
         $handling = Handling::where('complaint_id',$complaint->id)->first();

         $handling->user_id = $officer->user_id;
         $handling->save();
         
         activity()->log('Beri Penugasan dengan ID = '.$handling->id);
         return redirect('/process_complaint')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($complaint, $handling)
    {
       $handling = Crypt::decrypt($handling);
       $handling = Handling::where('id',$handling)->first();
       $handling->delete();

       activity()->log('Hapus Data Penanganan dengan ID = '.$handling->id);
       return redirect('/handling/'.$complaint)->with('status', 'Data Berhasil Dihapus');
    }
}
