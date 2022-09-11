<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;   //nama model
use App\Models\Handling;   //nama model
use App\Models\SwitchOfficer;   //nama model
use App\Models\User;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Image;

class HandlingController extends BaseController
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

        $handling = Complaint::whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->orderBy('id','DESC')->get();
        return $this->sendResponse($handling, 'Data Dispatch', $request->lang);
    }

    public function detail(Request $request)
    {
        
        $user = User::where('api_token', $request->header('token'))->first();   

        $handling = Complaint::where('id',$request->id)
                    ->whereHas('handling', function ($query) use ($user){
                        $query->where('user_id', $user->id);
                    })->orderBy('id','DESC')->get();
        return $this->sendResponse($handling, 'Detail Dispatch', $request->lang);
    }

    
    ## Simpan Data
    public function store(Request $request, $status)
    {
        
        if($status=='accept'){
            $validator = Validator::make($request->all(), [
                'coordinate_officer' => 'required'
            ]);

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }

        } elseif($status=='reject'){
            $validator = Validator::make($request->all(), [
                'description' => 'required'
            ]);

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }

        } else if($status=='done'){
            $validator = Validator::make($request->all(), [
                'diagnosis' => 'required',
                'handling' => 'required',
                'description' => 'required',
                'handling_status' => 'required',
                'reference_place' => 'required_if:handling_status,refer'
            ]); 

            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }
        }
        
        

        if($status=='accept'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->status = 'accept';
            $complaint->coordinate_officer = $request->coordinate_officer;
            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'accept';
            $handling->response_time = date('Y-m-d H:i:s');
            $handling->save();

            return response([
                'status' => true,
                'message' => 'Data Aduan Diterima',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        } else if($status=='reject'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->status = 'dispatch';
            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'reject';
            $handling->save();

            $switch_officer = new SwitchOfficer;
            $switch_officer->complaint_id = $request->id;
            $switch_officer->description = $request->description;
            $switch_officer->unit_id = $complaint->unit_id;
            $switch_officer->save();

            return response([
                'status' => true,
                'message' => 'Data Aduan Ditolak',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        } else if($status=='done'){

            $complaint = Complaint::where('id',$request->id)->first();
            $complaint->description = $request->description;
            $complaint->coordinate_officer = $request->coordinate_officer;
            $complaint->handling_status = $request->handling_status;
            if($request->handling_status == 'refer'){
                $complaint->reference_place = $request->reference_place;
            }
            $complaint->status = 'done';
            
            if ($request->file('photo_citizen')) {
                $complaint->photo_citizen = time() . '.' . $request->file('photo_citizen')->getClientOriginalExtension();

                $request->file('photo_citizen')->storeAs('public/upload/photo_citizen',  $complaint->photo_citizen);
                $request->file('photo_citizen')->storeAs('public/upload/photo_citizen/thumbnail',  $complaint->photo_citizen);

                $thumbnailpath = public_path('storage/upload/photo_citizen/thumbnail/' .  $complaint->photo_citizen);
                $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailpath);
            }

            $complaint->save();

            $handling = Handling::where('complaint_id',$request->id)->first();
            $handling->status = 'done';
            $handling->diagnosis = $request->diagnosis;
            $handling->handling = $request->handling;
            $handling->done_time = date('Y-m-d H:i:s');
            $handling->save();

            return response([
                'status' => true,
                'message' => 'Data Aduan Selesai Diproses',
                'data' => $handling,
            ], 200, array(), JSON_PRETTY_PRINT);

        }

        
    }


    

}
