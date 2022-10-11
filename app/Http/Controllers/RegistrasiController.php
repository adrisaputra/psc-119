<?php

namespace App\Http\Controllers;

use App\Models\User;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;

class RegistrasiController extends Controller
{
    public function registrasi()
    {
        $title = 'Registrasi';
        return view('auth.register', compact('title'));
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

		$input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['status'] = 1;
        $input['action'] = 'verification';
        $input['group_id'] = 2;
        
        $user = User::create($input);

        Mail::to($input['email'])->send(new NotifyMail($user));

		// return redirect('/')->with('status2','Registrasi Berhasil, Silahkan Login !');
		return redirect('/')->with('status2','Registrasi Berhasil, Periksa email Anda untuk tautan verifikasi !');

    }

    public function email_verification(Request $request)
    {
        $user = User::where('email', $request->email)
                        ->where('api_token', $request->token)
                        ->first();

        if (!is_null($user)) {
            $user->status = 'active';
            $user->email_verified_at = now();

            $user->save();

            $message = 'Akun anda telah aktif. Silahkan login melalui aplikasi';
            // return redirect('/')->with('status2','Akun Telah Aktif, Silahkan Login !');
        } else {
            $message = 'Tautan Kedaluwarsa';
            // return redirect('/')->with('status','Link Expired !');
        }

        return view('email.verification', compact('message'));
    }

}
