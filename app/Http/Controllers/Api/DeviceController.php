<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Officer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if($this->confirmToken($request) == self::$INVALID_TOKEN){
                return $this->sendError('Token Invalid', ['error' => 'Token not pair in your account'], 401, $request->lang);
            }elseif($this->confirmToken($request) == self::$EXPIRED_TOKEN){
                return $this->sendError('Token Expired', ['error' => 'Your account token has expired'], 401, $request->lang);
            } 

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $officer = Officer::select('name','device_id')->where('user_id',$user->id)->get();
        return $this->sendResponse($officer, 'Device ID', $request->lang);
    }

    
    public function update(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $officer = Officer::where('user_id',$user->id)->first();
        $officer->device_id = $request->device_id;
        $officer->save();

        $officer2 = Officer::select('name','device_id','updated_at')->where('user_id',$user->id)->first();
        return $this->sendResponse($officer2, 'Device ID', $request->lang);

    }
    
    
}
