<?php

namespace App\Http\Controllers;

use App\Models\Officer;   //nama model
use App\Models\Unit;   //nama model
use App\Models\Complaint;   //nama model
use App\Models\Category;   //nama model
use App\Models\Handling;   //nama model
use App\Models\SwitchOfficer;   //nama model
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
            'username' => 'required|string|alpha_dash',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'address' => 'required',
            'unit_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
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
        // $user->name = $request->name;
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
        
        // $user = User::where('id',$officer->user_id)->first();
        $user = User::find($officer->user_id);
        $user->status = 'block';
        $user->save();
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

    public function get2($unit)
    {
        $officer = Officer::where('unit_id',$unit)->get();
        
        echo "<option value=''>- Pilih Petugas -</option>";
        foreach($officer as $v){
            echo "<option value='".$v->id."' >".$v->name."</option>";
        }
    }

    public function emergency_request($user)
    {
        
        $user = Crypt::decrypt($user);
        $user = User::where('id',$user)->first();

        $title = "List Aduan";
        $complaint = Complaint::whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->whereHas('handling', function ($query){
                        $query->where('status', NULL)
                            ->orWhere('status', 'accept');
                    })->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.officer.emergency_request',compact('title','complaint'));
    }

    ## Tampilkan Form Edit
    public function emergency_detail(Request $request, $user , $complaint)
    {
        $title = "Laporan Masyarakat";
        $user = Crypt::decrypt($user);
        $user = User::where('id',$user)->first();

        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $category = Category::get();
        $unit = Officer::where('status','available')->get();
        $officer = Officer::where('unit_id',$complaint->unit_id)->first();
        $get_unit = Unit::where('id',$complaint->unit_id)->first();
        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $switch_officer = SwitchOfficer::where('complaint_id',$complaint->id)->get();
        $lat = "-5.4856429306487176";
        $long = "122.58496969552637";
        
        $view=view('admin.officer.emergency_detail', compact('title','user','complaint','category','get_unit','officer','handling','switch_officer'));
        $view=$view->render();
        return $view;
    }

    ## Hapus Data
    public function accept(Request $request, $user , $complaint)
    {
        $title = "Laporan Masyarakat";
        $user = Crypt::decrypt($user);
        $user = User::where('id',$user)->first();

        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();

        $complaint->status = 'accept';
        $complaint->coordinate_officer = '-5.465746452931535, 122.61993873042796';
        $complaint->save();

        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $handling->status = 'accept';
        $handling->response_time = date('Y-m-d H:i:s');
        $handling->save();

        $officer = Officer::where('user_id',$handling->user_id)->first();
        $officer->save();
        
        activity()->log('Laporan Masyarakat dengan ID = '.$complaint->id.' Diterima');
        return redirect('/officer/emergency_request/'.Crypt::encrypt($handling->user_id))->with('status', 'Data Berhasil Diterima');
    }

    ## Hapus Data
    public function reject(Request $request, $user , $complaint)
    {
        $title = "Laporan Masyarakat";
        $user = Crypt::decrypt($user);
        $user = User::where('id',$user)->first();

        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $complaint->status = 'dispatch';
        $complaint->save();

        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $handling->status = 'reject';
        $handling->save();

        $officer = Officer::where('user_id',$handling->user_id)->first();
        $officer->status = 'available';
        $officer->save();
        
        $switch_officer = new SwitchOfficer;
        $switch_officer->complaint_id = $complaint->id;
        $switch_officer->description = 'Di tolak';
        $switch_officer->unit_id = $officer->unit_id;
        $switch_officer->save();
        
        activity()->log('Laporan Masyarakat dengan ID = '.$complaint->id.' Ditolak');
        return redirect('/officer/emergency_request/'.Crypt::encrypt($handling->user_id))->with('status2', 'Data Ditolak');
    }

    ## Hapus Data
    public function done(Request $request, $user , $complaint)
    {
        $title = "Laporan Masyarakat";
        $user = Crypt::decrypt($user);
        $user = User::where('id',$user)->first();

        $complaint = Crypt::decrypt($complaint);
        $complaint = Complaint::where('id',$complaint)->first();
        $complaint->description = "Selesai";
        $complaint->handling_status = 'home';
        $complaint->status = 'done';
        $complaint->save();

        $handling = Handling::where('complaint_id',$complaint->id)->first();
        $handling->status = 'done';
        $handling->diagnosis = 'xxx';
        $handling->handling = 'aaa';
        $handling->done_time = date('Y-m-d H:i:s');
        $handling->save();

        $officer = Officer::where('user_id',$handling->user_id)->first();
        $officer->status = 'available';
        $officer->save();
        
        $switch_officer = new SwitchOfficer;
        $switch_officer->complaint_id = $complaint->id;
        $switch_officer->description = 'Di tolak';
        $switch_officer->unit_id = $officer->unit_id;
        $switch_officer->save();
        
        activity()->log('Laporan Masyarakat dengan ID = '.$complaint->id.' Ditolak');
        return redirect('/officer/emergency_request/'.Crypt::encrypt($handling->user_id))->with('status', 'Data Berhasil Diterima');
    }

}
