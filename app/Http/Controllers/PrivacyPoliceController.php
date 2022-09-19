<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPoliceController extends Controller
{
    public function index()
    {
        return view('privacy_police');
    }
}
