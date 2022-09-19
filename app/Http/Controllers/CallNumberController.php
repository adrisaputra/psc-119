<?php

namespace App\Http\Controllers;

use App\Models\CallNumber;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class CallNumberController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
     
     ## Tampikan Data
     public function index()
     {
         $title = "No. Telepon PSC";
         $call_number = CallNumber::orderBy('id','DESC')->paginate(25)->onEachSide(1);
         return view('admin.call_number.index',compact('title','call_number'));
     }
 
     ## Tampilkan Data Search
     public function search(Request $request)
     {
         $title = "No. Telepon PSC";
         $call_number = $request->get('search');
         $call_number = CallNumber::where('phone_number', 'LIKE', '%'.$call_number.'%')
                 ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
         
         return view('admin.call_number.index',compact('title','call_number'));
     }
     
     ## Tampilkan Form Create
     public function create()
     {
         $title = "No. Telepon PSC";
         $view=view('admin.call_number.create',compact('title'));
         $view=$view->render();
         return $view;
     }
 
     ## Simpan Data
     public function store(Request $request)
     {
         $this->validate($request, [
             'phone_number' => 'required',
             'description' => 'required'
         ]);
 
         $input['phone_number'] = $request->phone_number;
         $input['description'] = $request->description;
        
         CallNumber::create($input);
         
         activity()->log('Tambah Data Telepon PSC');
         return redirect('/call_number')->with('status','Data Tersimpan');
     }
 
     ## Tampilkan Form Edit
     public function edit($call_number)
     {
         $title = "No. Telepon PSC";
         $call_number = Crypt::decrypt($call_number);
         $call_number = CallNumber::where('id',$call_number)->first();
         $view=view('admin.call_number.edit', compact('title','call_number'));
         $view=$view->render();
         return $view;
     }
 
     ## Edit Data
     public function update(Request $request, $call_number)
     {
         
         $call_number = Crypt::decrypt($call_number);
         $call_number = CallNumber::where('id',$call_number)->first();
 
         $this->validate($request, [
            'phone_number' => 'required',
            'description' => 'required'
        ]);
 
         $call_number->fill($request->all());
         $call_number->save();
         
         activity()->log('Ubah Data Telepon PSC dengan ID = '.$call_number->id);
         return redirect('/call_number')->with('status', 'Data Berhasil Diubah');
     }
 
     ## Hapus Data
     public function delete($call_number)
     {
         $call_number = Crypt::decrypt($call_number);
         $call_number = CallNumber::where('id',$call_number)->first();
         $call_number->delete();
 
         activity()->log('Hapus Data Telepon PSC dengan ID = '.$call_number->id);
         return redirect('/call_number')->with('status', 'Data Berhasil Dihapus');
     }
     
}
