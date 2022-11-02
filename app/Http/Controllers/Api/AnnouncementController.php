<?php

namespace App\Http\Controllers\Api;

use App\Models\Announcement;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends BaseController
{

    public function index(Request $request)
    {
        $announcement = Announcement::where('date_start','<=', date('Y-m-d'))
                                    ->where('date_end','>=', date('Y-m-d'))
                                    ->orderBy('id','DESC')->get();

        $resultData = array();
        foreach($announcement as $v){
            $resultData[] = array(
                'id'=>$v->id,
                'title'=>$v->title,
                'text'=>$v->text,
                'image'=>url('/').'/storage/upload/announcement/thumbnail/'.$v->image,
                'date_start'=>$v->date_start,
                'date_end'=>$v->date_end,
                'created_at'=>$v->created_at,
                'updated_at'=>$v->updated_at
            );
        }
        return $this->sendResponse($resultData, 'Data Pengumuman', $request->lang);
    }

    public function detail($id)
    {
        $announcement = Announcement::where('id',$id)->first();
        $resultData = array(
            'id'=>$announcement->id,
            'title'=>$announcement->title,
            'text'=>$announcement->text,
            'image'=>url('/').'/storage/upload/announcement/thumbnail/'.$announcement->image,
            'date_start'=>$announcement->date_start,
            'date_end'=>$announcement->date_end,
            'created_at'=>$announcement->created_at,
            'updated_at'=>$announcement->updated_at
        );

        if($announcement){
            return $this->sendResponse($resultData, 'Detail Pengumuman', 'id');
        } else {
            return $this->sendError('Token Invalid', ['error' => 'Token not pair in your account'], 401, $request->lang);
        }
    }

}
