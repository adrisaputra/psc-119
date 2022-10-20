<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UnitController extends BaseController
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
        $unit = DB::table('units')
                    ->select('units.id as id','units.name as name','address','coordinate','category','image','time_operation'
                            ,'subdistricts.name as subdistrict_name','units.created_at as created_at','units.updated_at as updated_at')
                    ->join('subdistricts', 'subdistricts.id', '=', 'units.subdistrict_id')
                    ->get();

        $resultData = array();
        foreach($unit as $v){
            $resultData[] = array(
                'id'=>$v->id,
                'name'=>$v->name,
                'address'=>$v->address,
                'coordinate'=>$v->coordinate,
                'category'=>$v->category,
                'image'=>url('/').'/storage/upload/unit/thumbnail/'.$v->image,
                'time_operation'=>$v->time_operation,
                'subdistrict_name'=>$v->subdistrict_name,
                'created_at'=>$v->created_at,
                'updated_at'=>$v->updated_at
            );
        }
        return $this->sendResponse($resultData, 'Data Faskes', $request->lang);
    }
}
