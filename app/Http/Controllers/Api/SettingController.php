<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends BaseController
{
    // public function __construct()
    // {
    //     $this->middleware(function($request, $next) {
    //         if($this->confirmToken($request) == self::$INVALID_TOKEN){
    //             return $this->sendError('Token Invalid', ['error' => 'Token not pair in your account'], 401, $request->lang);
    //         }elseif($this->confirmToken($request) == self::$EXPIRED_TOKEN){
    //             return $this->sendError('Token Expired', ['error' => 'Your account token has expired'], 401, $request->lang);
    //         } 

    //         return $next($request);
    //     });
    // }
    
    public function index(Request $request)
    {
        $setting   = Setting::first();
        return $this->sendResponse($setting, 'Data Pengaturan', $request->lang);
    }

    public function psc_call_number(Request $request)
    {
        $psc_call_number   = Setting::select('psc_call_number')->first();
        return $this->sendResponse($psc_call_number, 'No Panggilan PSC', $request->lang);
    }

    public function time_refresh(Request $request)
    {
        $time_refresh   = Setting::select('time_refresh_tracking')->first();
        return $this->sendResponse($time_refresh, 'Waktu Refresh Tracking', $request->lang);
    }
}
