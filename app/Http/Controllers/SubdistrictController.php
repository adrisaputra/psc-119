<?php

namespace App\Http\Controllers;

use App\Models\Subdistrict;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class SubdistrictController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Kecamatan";
        $subdistrict = Subdistrict::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.subdistrict.index',compact('title','subdistrict'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Kecamatan";
        $subdistrict = $request->get('search');
        $subdistrict = Subdistrict::where('name', 'LIKE', '%'.$subdistrict.'%')
                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.subdistrict.index',compact('title','subdistrict'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Kecamatan";
		$view=view('admin.subdistrict.create',compact('title'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

		$input['name'] = $request->name;
		
        Subdistrict::create($input);
        
        activity()->log('Tambah Data Subdistrict');
		return redirect('/subdistrict')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($subdistrict)
    {
        $title = "Kecamatan";
        $subdistrict = Crypt::decrypt($subdistrict);
        $subdistrict = Subdistrict::where('id',$subdistrict)->first();
        $view=view('admin.subdistrict.edit', compact('title','subdistrict'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $subdistrict)
    {
        
        $subdistrict = Crypt::decrypt($subdistrict);
        $subdistrict = Subdistrict::where('id',$subdistrict)->first();

        $this->validate($request, [
            'name' => 'required',
        ]);

        $subdistrict->fill($request->all());
        
    	$subdistrict->save();
		
        activity()->log('Ubah Data Subdistrict dengan ID = '.$subdistrict->id);
		return redirect('/subdistrict')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($subdistrict)
    {
        $subdistrict = Crypt::decrypt($subdistrict);
        $subdistrict = Subdistrict::where('id',$subdistrict)->first();
    	$subdistrict->delete();

        activity()->log('Hapus Data Subdistrict dengan ID = '.$subdistrict->id);
        return redirect('/subdistrict')->with('status', 'Data Berhasil Dihapus');
    }
}
