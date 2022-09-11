<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends BaseController
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
         $content   = Content::with(['dtw_category','content_image'])->orderBy('created_at', 'ASC')
                        ->filter([
                            'search' => $request->get('search'),
                            'dtw' => $request->get('dtw'),
                            'route' => $request->get('route'),
                            'category' => $request->get('category'),
                            'id' => $request->get('id'),
                        ])->get();

        return $this->sendResponse($content, 'Content Data', $request->lang);
    }
}
