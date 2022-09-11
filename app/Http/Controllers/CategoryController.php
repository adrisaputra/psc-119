<?php

namespace App\Http\Controllers;

use App\Models\Category;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Image;

class CategoryController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Kategori";
        $category = Category::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.category.index',compact('title','category'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Kategori";
        $category = $request->get('search');
        $category = Category::where('name', 'LIKE', '%'.$category.'%')
                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.category.index',compact('title','category'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Kategori";
		$view=view('admin.category.create',compact('title'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:500'
        ]);

		$input['name'] = $request->name;
        
        if ($request->file('image')) {
            $input['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/image_category', $input['image']);
            $request->file('image')->storeAs('public/upload/image_category/thumbnail', $input['image']);

            $thumbnailpath = public_path('storage/upload/image_category/thumbnail/' . $input['image']);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

		$input['text'] = $request->text;
		
        Category::create($input);
        
        activity()->log('Tambah Data Category');
		return redirect('/category')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($category)
    {
        $title = "Kategori";
        $category = Crypt::decrypt($category);
        $category = Category::where('id',$category)->first();
        $view=view('admin.category.edit', compact('title','category'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $category)
    {
        
        $category = Crypt::decrypt($category);
        $category = Category::where('id',$category)->first();

        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($category->image && $request->file('image') != "") {
            $image_path = public_path() . '/storage/upload/image_category/thumbnail/' . $category->image;
            $image_path2 = public_path() . '/storage/upload/image_category/' . $category->image;
            unlink($image_path);
            unlink($image_path2);
        }

        $category->fill($request->all());
        
        if ($request->file('image')) {

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/image_category', $filename);
            $request->file('image')->storeAs('public/upload/image_category/thumbnail', $filename);

            $thumbnailpath = public_path('storage/upload/image_category/thumbnail/' . $filename);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $category->image = $filename;
        }

    	$category->save();
		
        activity()->log('Ubah Data Kategory dengan ID = '.$category->id);
		return redirect('/category')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($category)
    {
        $category = Crypt::decrypt($category);
        $category = Category::where('id',$category)->first();
    	$category->delete();

        activity()->log('Hapus Data Category dengan ID = '.$category->id);
        return redirect('/category')->with('status', 'Data Berhasil Dihapus');
    }
}
