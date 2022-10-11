<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends BaseController
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
        
        $user = User::where('api_token', $request->header('token'))->first();   

        $notification = Notification::where('email',$user->email)->get();
        return $this->sendResponse($notification, 'Notifikasi', $request->lang);
    }

    
    public function delete(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $notification = Notification::where('id',$request->id)->where('email',$user->email)->first();
        if($notification){
            $notification->delete();
            return $this->sendResponse(['Data Notifikasi Terhapus'],'Berhasil', $request->lang);
        } else {
            return $this->sendError('Gagal', ['error' => 'Data tidak ditemukan'], 401, $request->lang);
        }
    }
    
    public function clear(Request $request)
    {
        $user = User::where('api_token', $request->header('token'))->first();   

        $notification = Notification::where('email',$user->email)->delete();
        return $this->sendResponse(['Data Notifikasi Terhapus'],'Berhasil', $request->lang);
        
    }
    
}
