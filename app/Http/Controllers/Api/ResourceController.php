<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dtw_category;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class ResourceController extends BaseController
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

    public function slider(Request $request)
    {
        return $this->sendResponse(Slider::all(), 'Data Slider', $request->lang);
    }

    public function category(Request $request)
    {
        return $this->sendResponse(Category::all(), 'Data Kategori', $request->lang);
    }

    public function dtw(Request $request)
    {
        return $this->sendResponse(Dtw_category::all(), 'Data Kategori Tempat Wisata', $request->lang);
    }

    public function setting(Request $request)
    {
        return $this->sendResponse(Setting::find(1), 'Data Setting', $request->lang);
    }

    public function route(Request $request)
    {
        // $routes_id = [
        //     'route_water'  => 'AIR',
        //     'route_air'    => 'UDARA',
        //     'route_ground' => 'DARAT',
        // ];
        $routes = [
            ['route' => 'AIR' , 'icon' => 'tes.png'],
            ['route' => 'UDARA' , 'icon' => 'tes.png'],
            ['route' => 'DARAT' , 'icon' => 'tes.png'],
        ];

        return $this->sendResponse($routes, 'Data Rute', $request->lang);
    }
}
