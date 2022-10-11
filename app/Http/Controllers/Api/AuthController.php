<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Citizen;
use App\Models\Notification;
use App\Mail\NotifyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;

class AuthController extends BaseController
{
    /**
     * Login
     * 
     * @param request $request
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('group_id',6)->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                // check if account is not active
                if ($user->status != 'active') {
                    return $this->sendError('Gagal', ['error' => 'Mohon maaf akun belum di aktivasi, silahkan cek email aktivasi akun anda'], 401, $request->lang);
                }
    
                // update token if expired
                $this->updateToken($user);
    
                $user = User::select('users.id','users.name','email','email_verified_at','phone_number','address','nik',
                                'subdistrict_id','village_id','group_id','status','photo','api_token','api_expired','users.created_at','users.updated_at')
                    ->join('citizens', 'citizens.user_id', '=', 'users.id')
                    ->where('email' , $request->email)
                    ->first();   
                    
                return $this->sendResponse($user, 'User Login', $request->lang);
    
            } else {
                return $this->sendError('Gagal', ['error' => 'Maaf Password yang anda masukkan salah'], 401, $request->lang);
            }
        } else {
            return $this->sendError('Gagal', ['error' => 'Maaf email belum terdaftar'], 401, $request->lang);
        }
        
    }

    public function login_officer(Request $request)
    {
        $user = User::where('name', $request->name)->where('group_id',3)->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                // check if account is not active
                if ($user->status != 'active') {
                    return $this->sendError('Gagal', ['error' => 'Mohon maaf akun tidak aktif, silahkan hubungi admin PSC untuk mengaktifkan'], 401, $request->lang);
                }

                // update token if expired
                $this->updateToken($user);

                $user = User::select('users.id','users.name','email','email_verified_at','phone_number','users.status','group_id','photo','api_token','api_expired','users.created_at','users.updated_at')
                    ->join('officers', 'officers.user_id', '=', 'users.id')
                    ->where('users.name' , $request->name)
                    ->first();    
                    
                return $this->sendResponse($user, 'User Login', $request->lang);

            } else {
                return $this->sendError('Gagal', ['error' => 'Maaf Password yang anda masukkan salah'], 401, $request->lang);
            }
        } else {
            return $this->sendError('Gagal', ['error' => 'Maaf user belum terdaftar'], 401, $request->lang);
        }
    }

    /**
     * Register Account
     * 
     * @param request $request
     */
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone_number'     => 'required',
            'address'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nik' => 'required|unique:citizens|numeric|digits:16',
            'village_id' => 'required',
            'subdistrict_id' => 'required',
        ]);

        // return message if validation not passed
        if ($validator->fails()) {
            return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
        }


        // send email and check if its exist
        $token = Str::random(36);
        
        try {
            $data = [
                'email' => $request->email,
                'name' => $request->name,
                'token' => $token,
                'action' => 'verification',
                'lang' => $request->lang
            ];

            $notification = new Notification();
            $notification->email = $request->email;
            $notification->message = "Registrasi berhasil, Silahkan Cek Email Untuk Aktivasi";
            $notification->save();

            $this->notif_registration($data);
            $this->sendEmail($data);

        } catch (\Throwable $th) {
            return $this->sendError('Email Tidak Terdaftar', $th, 401, $request->lang);
        }


        // Create New User
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password  = Hash::make($request->password);
        $user->status    = 'block';
        $user->api_token = $token;
        $user->group_id   = 6;   ## Masyarakat
        $user->save();

        $citizen = new Citizen();
        $citizen->name = $request->name;
        $citizen->phone_number = $request->phone_number;
        $citizen->address = $request->address;
        $citizen->nik = $request->nik;
        $citizen->subdistrict_id = $request->subdistrict_id;
        $citizen->village_id = $request->village_id;
        $citizen->user_id = $user->id;
        $citizen->save();
        
        
        return $this->sendResponse(['Registrasi akun berhasil. Silahkan cek email untuk verfikasi akun'],'Berhasil', $request->lang);
    }

    /**
     * Reset Password
     */
    public function reset_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        
        if (is_null($user)) {
            return $this->sendError('Email Tidak Terdaftar', ['error' => 'Email Tidak Terdaftar'], 401, $request->lang);
        } else {
            $new_password = Str::random(8);
        
            try {
                $data = [
                    'email'    => $user->email,
                    'name'     => $user->name,
                    'password' => $new_password,
                    'action'   => 'reset',
                    'lang'   => $request->lang
                ];

                $this->sendEmail($data);

            } catch (\Throwable $th) {
                return $this->sendError('Email Not Exists', ['error' => $th], 401, $request->lang);
            }

            $user->password  = Hash::make($new_password);
            $user->save();

            return $this->sendResponse(['Berhasil reset password, cek email anda untuk password baru'], 'Berhasil', $request->lang);
        }
    }


    /**
     * Languace chooser
     * language : id, en
     */
    public function language(Request $request)
    {
        return $this->sendResponse(
            ($request->lang == 'en') ? $this->en : $this->id, 
            'Get Language Text', 
            $request->lang);
    }

    /**
     * Send Email Activation
     */

    public function sendEmail($data)
    {
        Mail::to($data['email'])->send(new NotifyMail($data));
        if (Mail::flushMacros()) {
            return $this->sendError('Email Tidak Terdaftar', ['error' => 'Email Tidak Terdaftar'], 401, $data['lang']);
        }

        return;
    }
    
    /**
     * Renew Token
     */
    public function renewToken(Request $request)
    {
        $user = User::where('email', $request->email)
                        ->where('api_token', $request->token)
                        ->first();
        
        if ($user) {
            $this->updateToken($user);
            
            $response = [
                'api_token' => $user->api_token,
                'api_expired' => $user->api_expired,
            ];

            return $this->sendResponse($response, 'Renewal Token Success', $request->lang);
        } else {
            $response = [
                'api_token' => "-",
                'api_expired' => date('Y-m-d H:i:s'),
            ];

            // return $this->sendError2('Token Not Exsist', $response, 401 , $request->lang);
            return $this->sendError('Token Not Exists', ['error' => '-'], 401, $request->lang);
        }
    }
    
    public function notif_registration($data)
	{
		/* Kirim Pesan */
		$msg = array(
			'body'  => 'Registrasi berhasil, Silahkan Cek Email Untuk Aktivasi',
			'title' => 'INFO PSC-119 Kota Baubau',
		);

		$server_key = 'AAAAY7iO1dQ:APA91bFFwvftfyDKdsb24HLuuYB0S73a2o-H84eTzx5ha0Ys2H_xziYt_U_QAdQDtI51vJs5GQEw_0QnX_w-9p0t7DYlIRfpGBgrS9raUMIOLmW8X7pXeC8B5HpIrRkg0OtY1R9yJUUm';

		$url            = 'https://fcm.googleapis.com/fcm/send';
		$fields['to']           = '/topics/'.$data['email'];
		$fields['notification'] = $msg;
		$headers        = array(
			'Content-Type:application/json',
			'Authorization:key=' . $server_key,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);

		// exit;
	}
}
