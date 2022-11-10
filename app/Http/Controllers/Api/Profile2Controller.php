<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Citizen;
use App\Models\Officer;
use App\Models\Village;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Profile2Controller extends BaseController
{

    public function update_officer(Request $request)
    {
        
        $user = User::where('email', $request->name)->where('group_id', 3)->first();  

        if($user){
            
            $officer = Officer::where('user_id', $user->id)->first();    

            if($request->get('current-password')){
                if (!(Hash::check($request->get('current-password'), $user->password))) {
                    $validator = Validator::make($request->all(), [
                        // 'name' => 'required|string|alpha_dash',
                        'current-password' => 'string|confirmed'
                    ]);
                } else {
    
                    if($request->get('password')){
                        if(!(strcmp($request->get('password'), $request->get('password_confirmation'))) == 0){
                            if($request->password){
                                $validator = Validator::make($request->all(), [
                                    // 'name' => 'required|string|alpha_dash',
                                    'password' => 'string|min:8|confirmed'
                                ]);
                            }
                        } 
                    }
    
                    if($request->password){
                        $validator = Validator::make($request->all(), [
                            // 'name' => 'required|string|alpha_dash',
                            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                            'password_confirmation' => 'min:8'
                        ]);
                    } 
					// else {
                        // $validator = Validator::make($request->all(), [
                            // 'name' => 'required|string|alpha_dash',
                        // ]);
                    // }
                }
    
                
                // // return message if validation not passed
                if ($validator->fails()) {
                    return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
                }
            } 
			// else {
                // $validator = Validator::make($request->all(), [
                    // 'name' => 'required|string|alpha_dash',
                // ]);
                
                // return message if validation not passed
                // if ($validator->fails()) {
                    // return $this->sendError2('Validation Error', ['error' => $validator->errors() ], 401, $request->lang);
                // }
            // }
            
            // $user->fill($request->all());
            if($request->password){
                $user->password = Hash::make($request->password);
            } else {
                $cek_user = User::where('id', $user->id)->first();
                $user->password = $cek_user->password;
            }
    
            if($request->photo){
                $photo = $request->photo;
                $folderPath = "public/upload/photo/"; //path location
                
                $photo = str_replace('data:image/png;base64,', '', $photo);
                $photo = str_replace(' ', '+', $photo);
                $photoName = time(). '.png';
                $user->photo = $photoName;
                $file = $folderPath . $photoName;
                file_put_contents($file, base64_decode($photo));
            }
    
            $user->save();
    
            // $officer->phone_number = $request->phone_number;
            // $officer->save();
            
            return $this->sendResponse([], 'Berhasil update profile', $request->lang);
    
        } else {
            return $this->sendError('Unauthorized', ['error' => 'Account Unauthorized or not registered'], 401, $request->lang);
        }
        
    }

}
