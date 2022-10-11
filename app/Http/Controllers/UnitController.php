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
use Image;


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
            'image' => 'mimes:jpg,jpeg,png|max:500',
        ]);

		$input['name'] = $request->name;
		$input['address'] = $request->address;
		$input['category'] = $request->category;
		$input['image'] = $request->image;
		$input['time_operation'] = $request->time_operation;
		$input['subdistrict_id'] = $request->subdistrict_id;
		$input['coordinate'] = $request->lat.', '.$request->long;
        
        if ($request->file('image')) {
            $input['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/unit', $input['image']);
            $request->file('image')->storeAs('public/upload/unit/thumbnail', $input['image']);

            $thumbnailpath = public_path('storage/upload/unit/thumbnail/' . $input['image']);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

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
            'image' => 'mimes:jpg,jpeg,png|max:500',
        ]);

        if ($unit->image && $request->file('image') != "") {
            $image_path = public_path() . '/storage/upload/unit/thumbnail/' . $unit->image;
            $image_path2 = public_path() . '/storage/upload/unit/' . $unit->image;
            unlink($image_path);
            unlink($image_path2);
        }

        $unit->fill($request->all());
        
        if ($request->file('image')) {

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/unit', $filename);
            $request->file('image')->storeAs('public/upload/unit/thumbnail', $filename);

            $thumbnailpath = public_path('storage/upload/unit/thumbnail/' . $filename);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $unit->image = $filename;
        }

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
