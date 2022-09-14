<?php

namespace App\Http\Controllers\Api;

use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubdistrictController extends BaseController
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
        $subdistrict   = Subdistrict::get();
        return $this->sendResponse($subdistrict, 'Data Kecamatan', $request->lang);
    }
}
