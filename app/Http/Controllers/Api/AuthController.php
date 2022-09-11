<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Citizen;
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
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // check if account is not active
            if ($user->status != 'active') {
                return $this->sendError('Unauthorized', ['error' => 'Account blocked by system'], 401, $request->lang);
            }

            // update token if expired
            $this->updateToken($user);

            return $this->sendResponse($user, 'User Login', $request->lang);

        } else {
            return $this->sendError('Unauthorized', ['error' => 'Account Unauthorized or not registered'], 401, $request->lang);
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

            $this->sendEmail($data);

        } catch (\Throwable $th) {
            return $this->sendError('Email Not Exists', $th, 401, $request->lang);
        }


        // Create New User
        $user = new User();
        $user->fill($request->all());

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
        $citizen->village_id = $request->village_id;
        $citizen->user_id = $user->id;
        $citizen->save();
        
        return $this->sendResponse([], 'Successfully registered new account. Check your email for verification', $request->lang);
    }

    /**
     * Reset Password
     */
    public function reset_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        
        if (is_null($user)) {
            return $this->sendError('Email not registered', ['error' => 'Email not registered'], 401, $request->lang);
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

            return $this->sendResponse([], 'Successfully reset password, Check your email for new password', $request->lang);
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
            return $this->sendError('Email Not Exists', ['error' => 'Email Not Exist'], 401, $data['lang']);
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
}
