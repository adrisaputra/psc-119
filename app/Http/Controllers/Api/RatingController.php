<?php

namespace App\Http\Controllers\Api;

use App\Models\Rating;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RatingController extends BaseController
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

    /**
     * 
     */
    public function rating(Request $request)
    {
        
        
        if($this->confirmToken($request) == self::$INVALID_TOKEN){
            return $this->sendError('Token Invalid', ['error' => 'Token not pair in your account'], 401, $request->lang);
        }elseif($this->confirmToken($request) == self::$EXPIRED_TOKEN){
            return $this->sendError('Token Expired', ['error' => 'Your account token has expired'], 401, $request->lang);
        }else {
        
            $validator = Validator::make($request->all(), [
                'review'     => 'required',
                'rating'     => 'required',
            ]);
    
            // return message if validation not passed
            if ($validator->fails()) {
                return $this->sendError('Validation Error', ['error' => $validator->errors() ], 400, $request->lang);
            }
    
            $rating = new Rating();
            $rating->fill($request->only(['review','rating','content_id','user_id']));
            
            $rating->save();
    
            // Update Content Rating
            $this->update_rating($request);
    
            return $this->sendResponse([], 'Successfully give rating and review', $request->lang);
        }
    }

    /**
     * 
     */
    public function review(Request $request) 
    {
        // $review = Rating::where('content_id', $request->content_id)->get();
        $review = Rating::select('ratings.*', 'users.name')
                        ->leftJoin('users', 'users.id', '=', 'ratings.user_id')
                        ->where('content_id', $request->content_id)->get();
        return $this->sendResponse($review, 'Get review', $request->lang);
    }

    /**
     * 
     */
    public function update_rating($request)
    {
        $rating = Rating::where('content_id', $request->content_id)->avg('rating');
        
        $content = Content::where('id', $request->content_id)->first();
        
        $content->rating = $rating;
        $content->save();
    }
}
