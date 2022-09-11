<?php

namespace App\Http\Controllers;

use App\Models\UnitService;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Menu;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class UnitServiceController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
     
     ## Tampikan Data
     public function index($unit)
     {
        $title = "Layanan";
         
        $unit = Crypt::decrypt($unit);
        $unit = Unit::where('id',$unit)->first();
 
        $unit_service = UnitService::where('unit_id',$unit->id)->orderBy('id','ASC')->paginate(25)->onEachSide(1);
 
        return view('admin.unit_service.index',compact('title','unit','unit_service'));
     }
 
     ## Tampilkan Data Search
     public function search(Request $request, $unit)
     {
         $title = "Layanan";
 
         $unit = Crypt::decrypt($unit);
         $unit = Unit::where('id',$unit)->first();
 
         $search = $request->get('search');
         $unit_service = UnitService::where('unit_id',$unit->id)->where('service', 'LIKE', '%'.$search.'%')->orderBy('id','ASC')->paginate(25)->onEachSide(1);
         
         return view('admin.unit_service.index',compact('title','unit','unit_service'));
     }
     
     ## Tampilkan Form Create
     public function create($unit)
     {
         $title = "Layanan";
         
         $unit = Crypt::decrypt($unit);
         $unit = Unit::where('id',$unit)->first();
 
         $view=view('admin.unit_service.create',compact('title','unit'));
         $view=$view->render();
         return $view;
     }
 
     ## Simpan Data
     public function store($unit, Request $request)
     {
         
        $unit = Crypt::decrypt($unit);
 
         $this->validate($request, [
             'service' => 'required',
         ]);
 
         $input['service'] = $request->service;
         $input['description'] = $request->description;
         $input['unit_id'] = $unit;
         
         UnitService::create($input);
         
         activity()->log('Tambah Data Layanan');
         return redirect('/unit_service/'.Crypt::encrypt($unit))->with('status','Data Tersimpan');
     }
 
     ## Tampilkan Form Edit
     public function edit($unit, $unit_service)
     {
        $title = "Layanan";
        
        $unit = Crypt::decrypt($unit);
        $unit = Unit::where('id',$unit)->first();
 
        $unit_service = Crypt::decrypt($unit_service);
        $unit_service = UnitService::where('id',$unit_service)->first();
 
        $view=view('admin.unit_service.edit', compact('title','unit','unit_service'));
        $view=$view->render();
        return $view;
     }
 
     ## Edit Data
     public function update(Request $request, $unit, $unit_service)
     {
        $unit_service = Crypt::decrypt($unit_service);
        $unit_service = UnitService::where('id',$unit_service)->first();
 
        $this->validate($request, [
            'service' => 'required',
        ]);
 
        $unit_service->fill($request->all());
        $unit_service->save();
        
        activity()->log('Ubah Data Layanan dengan ID = '.$unit_service->id);
        return redirect('/unit_service/'.$unit)->with('status', 'Data Berhasil Diubah');
     }
 
     ## Hapus Data
     public function delete($unit, $unit_service)
     {
        $unit_service = Crypt::decrypt($unit_service);
        $unit_service = UnitService::where('id',$unit_service)->first();
        $unit_service->delete();
 
        activity()->log('Hapus Data Layanan dengan ID = '.$unit_service->id);
        return redirect('/unit_service/'.$unit)->with('status', 'Data Berhasil Dihapus');
     }
}
