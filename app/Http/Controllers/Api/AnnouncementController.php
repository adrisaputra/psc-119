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
        return $this->sendResponse($announcement, 'Data Pengumuman', $request->lang);
    }

}
