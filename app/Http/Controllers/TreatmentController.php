<?php

namespace App\Http\Controllers;

use App\Models\Treatment;   //nama model
use App\Models\Category;   //nama model
use App\Models\Menu;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class TreatmentController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index($category)
    {
       $title = "Tindakan";
        
       $category = Crypt::decrypt($category);
       $category = Category::where('id',$category)->first();

       $treatment = Treatment::where('category_id',$category->id)->orderBy('id','ASC')->paginate(25)->onEachSide(1);

       return view('admin.treatment.index',compact('title','category','treatment'));
    }

    ## Tampilkan Data Search
    public function search(Request $request, $category)
    {
        $title = "Tindakan";

        $category = Crypt::decrypt($category);
        $category = Category::where('id',$category)->first();

        $search = $request->get('search');
        $treatment = Treatment::where('category_id',$category->id)->where('text', 'LIKE', '%'.$search.'%')->orderBy('id','ASC')->paginate(25)->onEachSide(1);
        
        return view('admin.treatment.index',compact('title','category','treatment'));
    }
    
    ## Tampilkan Form Create
    public function create($category)
    {
        $title = "Tindakan";
        
        $category = Crypt::decrypt($category);
        $category = Category::where('id',$category)->first();

        $view=view('admin.treatment.create',compact('title','category'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store($category, Request $request)
    {
        
       $category = Crypt::decrypt($category);

        $this->validate($request, [
            'text' => 'required'
        ]);

        $input['text'] = $request->text;
        $input['category_id'] = $category;
        
        Treatment::create($input);
        
        activity()->log('Tambah Data Tindakan');
        return redirect('/treatment/'.Crypt::encrypt($category))->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($category, $treatment)
    {
       $title = "Tindakan";
       
       $category = Crypt::decrypt($category);
       $category = Category::where('id',$category)->first();

       $treatment = Crypt::decrypt($treatment);
       $treatment = Treatment::where('id',$treatment)->first();

       $view=view('admin.treatment.edit', compact('title','category','treatment'));
       $view=$view->render();
       return $view;
    }

    ## Edit Data
    public function update(Request $request, $category, $treatment)
    {
       $treatment = Crypt::decrypt($treatment);
       $treatment = Treatment::where('id',$treatment)->first();

       $this->validate($request, [
           'text' => 'required'
       ]);

       $treatment->fill($request->all());
       $treatment->save();
       
       activity()->log('Ubah Data Tindakan dengan ID = '.$treatment->id);
       return redirect('/treatment/'.$category)->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($category, $treatment)
    {
       $treatment = Crypt::decrypt($treatment);
       $treatment = Treatment::where('id',$treatment)->first();
       $treatment->delete();

       activity()->log('Hapus Data Tindakan dengan ID = '.$treatment->id);
       return redirect('/treatment/'.$category)->with('status', 'Data Berhasil Dihapus');
    }
}
