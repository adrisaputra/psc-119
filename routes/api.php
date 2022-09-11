<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\HandlingController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\VillageController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UnitServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('reset_password', 'reset_password');
    Route::get('language', 'language');
    Route::post('renew_token', 'renewToken');
});

// profile
Route::controller(ProfileController::class)->group(function() {
    Route::get('profile', 'profile');
    Route::post('profile', 'update');
});

// content
Route::controller(ContentController::class)->group(function() {
    Route::get('content', 'index');
});

// rating review
Route::controller(RatingController::class)->group(function() {
    Route::get('review', 'review');
    Route::post('review', 'rating');
});

// all standalone resourcess
Route::controller(ResourceController::class)->group(function() {
    Route::get('dashboard_slider', 'slider');
    Route::get('category', 'category');
    Route::get('dtw', 'dtw');
    Route::get('setting', 'setting');
    Route::get('route', 'route');
});

// 
Route::controller(ComplaintController::class)->group(function() {
    Route::get('complaint', 'index');
    Route::post('medical_request/{report_type}', 'store');
});

Route::controller(HandlingController::class)->group(function() {
    Route::get('emergency_request', 'index');
    Route::get('detail_emergency_request', 'detail');
    Route::post('handling/{status}', 'store');
});

Route::controller(AnnouncementController::class)->group(function() {
    Route::get('announcement', 'index');
});

Route::controller(VillageController::class)->group(function() {
    Route::get('village', 'index');
});

Route::controller(UnitController::class)->group(function() {
    Route::get('medical_facility', 'index');
});

Route::controller(UnitServiceController::class)->group(function() {
    Route::get('medical_service', 'index');
});
