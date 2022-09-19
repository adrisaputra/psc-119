<?php

namespace App\Http\Controllers\Api;

use App\Models\CallNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallNumberController extends BaseController
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
        $call_number   = CallNumber::get();
        return $this->sendResponse($call_number, 'Data No Panggilan PSC', $request->lang);
    }

}
