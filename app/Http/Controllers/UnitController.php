<?php

namespace App\Http\Controllers;

use App\Models\Unit;   //nama model
use App\Models\Subdistrict;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class UnitController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Puskesmas";
        $unit = Unit::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.unit.index',compact('title','unit'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Puskesmas";
        $unit = $request->get('search');
        $unit = Unit::where('title', 'LIKE', '%'.$unit.'%')
                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.unit.index',compact('title','unit'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Puskesmas";
        $subdistrict = Subdistrict::get();
        $lat = "-5.4856429306487176";
        $long = "122.58496969552637";
		$view=view('admin.unit.create', compact('title','subdistrict', 'lat', 'long'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'subdistrict_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

		$input['name'] = $request->name;
		$input['address'] = $request->address;
		$input['subdistrict_id'] = $request->subdistrict_id;
		$input['coordinate'] = $request->lat.', '.$request->long;
        Unit::create($input);
        
        activity()->log('Tambah Data Unit');
		return redirect('/unit')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($unit)
    {
        $title = "Puskesmas";
        $unit = Crypt::decrypt($unit);
        $unit = Unit::where('id',$unit)->first();
        $subdistrict = Subdistrict::get();
        $view=view('admin.unit.edit', compact('title','unit','subdistrict'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $unit)
    {
        
        $unit = Crypt::decrypt($unit);
        $unit = Unit::where('id',$unit)->first();

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'subdistrict_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $unit->fill($request->all());
		$unit->coordinate = $request->lat.', '.$request->long;
    	$unit->save();
		
        activity()->log('Ubah Data Kategory dengan ID = '.$unit->id);
		return redirect('/unit')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($unit)
    {
        $unit = Crypt::decrypt($unit);
        $unit = Unit::where('id',$unit)->first();
    	$unit->delete();

        activity()->log('Hapus Data Unit dengan ID = '.$unit->id);
        return redirect('/unit')->with('status', 'Data Berhasil Dihapus');
    }
}
