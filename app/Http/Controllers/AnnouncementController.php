<?php

namespace App\Http\Controllers;

use App\Models\Announcement;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Image;

class AnnouncementController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        $title = "Pengumuman";
        $announcement = Announcement::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.announcement.index',compact('title','announcement'));
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $title = "Pengumuman";
        $announcement = $request->get('search');
        $announcement = Announcement::where('title', 'LIKE', '%'.$announcement.'%')
                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        
        return view('admin.announcement.index',compact('title','announcement'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
        $title = "Pengumuman";
		$view=view('admin.announcement.create',compact('title'));
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:500',
        ]);

		$input['title'] = $request->title;
		$input['text'] = $request->text;
		
        if ($request->file('image')) {
            $input['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/announcement', $input['image']);
            $request->file('image')->storeAs('public/upload/announcement/thumbnail', $input['image']);

            $thumbnailpath = public_path('storage/upload/announcement/thumbnail/' . $input['image']);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }

        $start_d = substr($request->date_start,0,2);
        $start_m = substr($request->date_start,3,2);
        $start_y = substr($request->date_start,6,4);
        $input['date_start'] = $start_y.'-'.$start_m.'-'.$start_d;

        $end_d = substr($request->date_end,0,2);
        $end_m = substr($request->date_end,3,2);
        $end_y = substr($request->date_end,6,4);
        $input['date_end'] = $end_y.'-'.$end_m.'-'.$end_d;

        Announcement::create($input);
        
        activity()->log('Tambah Data Announcement');
		return redirect('/announcement')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit($announcement)
    {
        $title = "Pengumuman";
        $announcement = Crypt::decrypt($announcement);
        $announcement = Announcement::where('id',$announcement)->first();
        $view=view('admin.announcement.edit', compact('title','announcement'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, $announcement)
    {
        
        $announcement = Crypt::decrypt($announcement);
        $announcement = Announcement::where('id',$announcement)->first();

        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:500',
        ]);

        if ($announcement->image && $request->file('image') != "") {
            $image_path = public_path() . '/storage/upload/announcement/thumbnail/' . $announcement->image;
            $image_path2 = public_path() . '/storage/upload/announcement/' . $announcement->image;
            unlink($image_path);
            unlink($image_path2);
        }

        $announcement->fill($request->all());
        
        if ($request->file('image')) {

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/upload/announcement', $filename);
            $request->file('image')->storeAs('public/upload/announcement/thumbnail', $filename);

            $thumbnailpath = public_path('storage/upload/announcement/thumbnail/' . $filename);
            $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $announcement->image = $filename;
        }

        $start_d = substr($request->date_start,0,2);
        $start_m = substr($request->date_start,3,2);
        $start_y = substr($request->date_start,6,4);
        $announcement->date_start = $start_y.'-'.$start_m.'-'.$start_d;

        $end_d = substr($request->date_end,0,2);
        $end_m = substr($request->date_end,3,2);
        $end_y = substr($request->date_end,6,4);
        $announcement->date_end = $end_y.'-'.$end_m.'-'.$end_d;

    	$announcement->save();
		
        activity()->log('Ubah Data Kategory dengan ID = '.$announcement->id);
		return redirect('/announcement')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete($announcement)
    {
        $announcement = Crypt::decrypt($announcement);
        $announcement = Announcement::where('id',$announcement)->first();
    	$announcement->delete();

        activity()->log('Hapus Data Announcement dengan ID = '.$announcement->id);
        return redirect('/announcement')->with('status', 'Data Berhasil Dihapus');
    }
    
}
