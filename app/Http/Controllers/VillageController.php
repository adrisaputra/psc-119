<?php

namespace App\Http\Controllers;

use App\Models\Village;   //nama model
use App\Models\Subdistrict;   //nama model
use App\Models\Menu;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class VillageController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($subdistrict)
    {
       $title = "Kelurahan";
        
       $subdistrict = Crypt::decrypt($subdistrict);
       $subdistrict = Subdistrict::where('id',$subdistrict)->first();

       $village = Village::where('subdistrict_id',$subdistrict->id)->orderBy('id','ASC')->paginate(25)->onEachSide(1);

       return view('admin.village.index',compact('title','subdistrict','village'));
    }

    ## Tampilkan Data Search
    public function search(Request $request, $subdistrict)
    {
        $title = "Kelurahan";

        $subdistrict = Crypt::decrypt($subdistrict);
        $subdistrict = Subdistrict::where('id',$subdistrict)->first();

        $search = $request->get('search');
        $village = Village::where('subdistrict_id',$subdistrict->id)->where('name', 'LIKE', '%'.$search.'%')->orderBy('id','ASC')->paginate(25)->onEachSide(1);
        
        return view('admin.village.index',compact('title','subdistrict','village'));
    }
    
    ## Tampilkan Form Create
    public function create($subdistrict)
    {
        $title = "Kelurahan";
        
        $subdistrict = Crypt::decrypt($subdistrict);
        $subdistrict = Subdistrict::where('id',$subdistrict)->first();

        $view=view('admin.village.create',compact('title','subdistrict'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store($subdistrict, Request $request)
    {
        
       $subdistrict = Crypt::decrypt($subdistrict);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $input['name'] = $request->name;
        $input['subdistrict_id'] = $subdistrict;
        
        Village::create($input);
        
        activity()->log('Tambah Data Kelurahan');
        return redirect('/village/'.Crypt::encrypt($subdistrict))->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($subdistrict, $village)
    {
       $title = "Kelurahan";
       
       $subdistrict = Crypt::decrypt($subdistrict);
       $subdistrict = Subdistrict::where('id',$subdistrict)->first();

       $village = Crypt::decrypt($village);
       $village = Village::where('id',$village)->first();

       $view=view('admin.village.edit', compact('title','subdistrict','village'));
       $view=$view->render();
       return $view;
    }

    ## Edit Data
    public function update(Request $request, $subdistrict, $village)
    {
       $village = Crypt::decrypt($village);
       $village = Village::where('id',$village)->first();

       $this->validate($request, [
           'name' => 'required'
       ]);

       $village->fill($request->all());
       $village->save();
       
       activity()->log('Ubah Data Kelurahan dengan ID = '.$village->id);
       return redirect('/village/'.$subdistrict)->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($subdistrict, $village)
    {
       $village = Crypt::decrypt($village);
       $village = Village::where('id',$village)->first();
       $village->delete();

       activity()->log('Hapus Data Kelurahan dengan ID = '.$village->id);
       return redirect('/village/'.$subdistrict)->with('status', 'Data Berhasil Dihapus');
    }
}
