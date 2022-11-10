<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Officer;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AmbulanceController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Ambulance";
        $ambulance = Ambulance::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.ambulance.index',compact('title','ambulance'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Ambulance";
        $ambulance = $request->get('search');
        $ambulance = Ambulance::
                where(function ($query) use ($ambulance) {
                    $query->where('police_number', 'LIKE', '%'.$ambulance.'%');
                })->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.ambulance.index',compact('title','ambulance'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Ambulance";
        $unit = Unit::get();
		$view=view('admin.ambulance.create',compact('title','unit'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'police_number' => 'required',
            'unit_id' => 'required',
            'officer_id' => 'required|unique:ambulances',
        ]);

		$input['police_number'] = $request->police_number;
		$input['unit_id'] = $request->unit_id;
		$input['officer_id'] = $request->officer_id;
		
        Ambulance::create($input);
        
        activity()->log('Tambah Data Ambulance');
		return redirect('/ambulance')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($ambulance)
    {
        $title = "Ambulance";
        $ambulance = Crypt::decrypt($ambulance);
        $ambulance = Ambulance::where('id',$ambulance)->first();
        $unit = Unit::get();
        $officer = Officer::get();
        $view=view('admin.ambulance.edit', compact('title','ambulance','unit','officer'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $ambulance)
    {
        
        $ambulance = Crypt::decrypt($ambulance);
        $ambulance = Ambulance::where('id',$ambulance)->first();

        $this->validate($request, [
            'police_number' => 'required',
            'unit_id' => 'required',
            'officer_id' => 'required',
        ]);


        $ambulance->fill($request->all());
    	$ambulance->save();
		
        activity()->log('Ubah Data Ambulance dengan ID = '.$ambulance->id);
		return redirect('/ambulance')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($ambulance)
    {
        $ambulance = Crypt::decrypt($ambulance);
        $ambulance = Ambulance::where('id',$ambulance)->first();
    	$ambulance->delete();

        activity()->log('Hapus Data Ambulance dengan ID = '.$ambulance->id);
        return redirect('/ambulance')->with('status', 'Data Berhasil Dihapus');
    }
}
