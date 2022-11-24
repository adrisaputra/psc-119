<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    
    public function index(Request $request)
    {

        $category = array(
                        array("key"=> "hospital", "name"=> "Rumah Sakit"),
                        array("key"=> "health center", "name"=> "Puskesmas"),
                        array("key"=> "clinic", "name"=> "Klinik"),
                        array("key"=> "drugstore", "name"=> "Apotek"),
                        array("key"=> "practicing doctor", "name"=> "Dokter Praktek")
                    );

        return $this->sendResponse($category, 'Data Category', $request->lang);
    }
}
