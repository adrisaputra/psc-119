<?php

namespace App\Http\Controllers;

use App\Models\Officer;   //nama model
use App\Models\Unit;   //nama model
use App\Models\User;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class OfficerController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Officer";
        $officer = Officer::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.officer.index',compact('title','officer'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Officer";
        $officer = $request->get('search');
        $officer = Officer::where('officer_name', 'LIKE', '%'.$officer.'%')
                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.officer.index',compact('title','officer'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Officer";
        $unit = Unit::get();
		$view=view('admin.officer.create',compact('title','unit'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'unit_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make('pass1234');
        $user->group_id = 3;
        $user->status = 'active';
        $user->save();

        $officer = new Officer();
        $officer->name = $request->name;
        $officer->phone_number = $request->phone_number;
        $officer->address = $request->address;
        $officer->status = 'available';
        $officer->unit_id = $request->unit_id;
        $officer->user_id = $user->id;
        $officer->save();
        
        activity()->log('Tambah Data Officer');
		return redirect('/officer')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($officer)
    {
        $title = "Officer";
        $officer = Crypt::decrypt($officer);
        $officer = Officer::where('id',$officer)->first();
        $unit = Unit::get();
        $view=view('admin.officer.edit', compact('title','officer','unit'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $officer)
    {
        
        $officer = Crypt::decrypt($officer);
        $officer = Officer::where('id',$officer)->first();

        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'unit_id' => 'required',
        ]);


        $officer->fill($request->all());
    	$officer->save();

        $user = User::where('id',$officer->user_id)->first();
        $user->name = $request->name;
        $user->save();
		
        activity()->log('Ubah Data Officer dengan ID = '.$officer->id);
		return redirect('/officer')->with('status', 'Data Berhasil Diubah');
        // echo $request->name;
    }

    ## Hapus Data
    public function delete($officer)
    {
        $officer = Crypt::decrypt($officer);
        $officer = Officer::where('id',$officer)->first();
    	$officer->delete();
        
        $user = User::where('id',$officer->user_id)->first();
    	$user->delete();

        activity()->log('Hapus Data Officer dengan ID = '.$officer->id);
        return redirect('/officer')->with('status', 'Data Berhasil Dihapus');
    }

    ## Get Data
    public function get($unit)
    {
        $officer = Officer::where('unit_id',$unit)->get();
        return view('admin.ambulance.get_officer',compact('officer'));
    }
}
