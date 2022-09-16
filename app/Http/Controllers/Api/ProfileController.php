<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ProfileController extends BaseController
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

    public function profile(Request $request)
    {
        $user = User::where('email' , $request->email)->where('api_token', $request->header('token'))->first();   
        $user = User::select('users.id','users.name','email','email_verified_at','phone_number','address','nik',
                            'subdistrict_id','village_id','group_id','status','photo','api_token','api_expired','users.created_at','users.updated_at')
                ->join('citizens', 'citizens.user_id', '=', 'users.id')
                ->where('email' , $request->email)->where('api_token', $request->header('token'))
                ->first();   

        return $this->sendResponse($user, 'Profile Data', $request->lang);
    }

    public function update(Request $request)
    {
        
        $user = User::where('email' , $request->email)->where('api_token', $request->header('token'))->first();  
        $citizen = Citizen::where('user_id', $user->id)->first();    

        if($request->get('current-password')){
            if (!(Hash::check($request->get('current-password'), $user->password))) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'photo' => 'mimes:jpg,jpeg,png|max:300',
                    'current-password' => 'string|confirmed'
                ]);
            } else {

                if($request->get('password')){
                    if(!(strcmp($request->get('password'), $request->get('password_confirmation'))) == 0){
                        if($request->password){
                            $validator = Validator::make($request->all(), [
                                'email' => 'required|email',
                                'password' => 'string|min:8|confirmed'
                            ]);
                        }
                    } 
                }

                if($request->password){
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
                        'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                        'password_confirmation' => 'min:8'
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email'
                    ]);
                }
            }

            
            // // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone_number'     => 'required',
                'address'     => 'required',
                'email'    => 'required|email',
                'nik' => 'required|numeric|digits:16',
                'village_id' => 'required'
            ]);
            
            // // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
            }
        }
        
        $user->fill($request->all());
        if($request->password){
            $user->password = Hash::make($request->password);
        } else {
            $cek_user = User::where('id', $user->id)->first();
            $user->password = $cek_user->password;
        }

        if($request->file('photo') == ""){}
        else
        {	
            $filename = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/photo'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        $citizen->fill($request->all());
        $citizen->save();

        
        return $this->sendResponse([], 'Successfully update profile', $request->lang);

    }
}
