<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HandlingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitServiceController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SubdistrictController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\CallNumberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MenuAccessController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuAccessController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrivacyPoliceController;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::get('/buat_storage', function () {
    Artisan::call('storage:link');
    dd("Storage Berhasil Di Buat");
});

Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    dd("Cache Clear All");
});

if (file_exists(app_path('Http/Controllers/LocalizationController.php')))
{
    Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class , 'lang']);
}

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [LoginController::class, 'index']);

Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

// testing email
Route::get('/email_verification', [RegistrasiController::class, 'email_verification']);

Route::post('/login_w', [LoginController::class, 'authenticate']);
Route::get('registrasi_w', [RegistrasiController::class, 'registrasi']);
Route::post('registrasi_w', [RegistrasiController::class, 'store']);
Route::post('/logout-sistem', [LoginController::class, 'logout']);

Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/profil/{user}', [UserController::class, 'edit_profil']);
Route::put('/profil/{user}', [UserController::class, 'update_profil']);

Route::get('database',[DatabaseController::class, 'index']);
Route::post('import_database',[DatabaseController::class, 'store']);
Route::get('/backup_database', function() {
    Artisan::call('database:backup');
    return response()->download(public_path().'/db_backup/backup-' . Carbon::now()->format('Y-m-d') . '.sql');
});

Route::middleware(['user_access'])->group(function () {
    
    ## Aduan Masuk
    Route::get('/incoming_complaint', [ComplaintController::class, 'index']);
    Route::get('/incoming_complaint/search', [ComplaintController::class, 'search']);
    Route::get('/incoming_complaint/create', [ComplaintController::class, 'create']);
    Route::post('/incoming_complaint', [ComplaintController::class, 'store']);
    Route::get('/incoming_complaint/detail/{complaint}', [ComplaintController::class, 'detail']);
    Route::put('/incoming_complaint/process/{complaint}', [ComplaintController::class, 'process']);
    Route::get('/incoming_complaint/edit/{complaint}', [ComplaintController::class, 'edit']);
    Route::put('/incoming_complaint/edit/{complaint}', [ComplaintController::class, 'update']);
    Route::put('/incoming_complaint/reject/{complaint}', [ComplaintController::class, 'reject']);
    Route::get('/incoming_complaint/hapus/{complaint}',[ComplaintController::class, 'delete']);
    Route::get('/incoming_complaint/kota',[ComplaintController::class, 'kota']);

    ## Aduan diproses
    Route::get('/process_complaint', [ComplaintController::class, 'index']);
    Route::get('/process_complaint/search', [ComplaintController::class, 'search']);
    // Route::get('/process_complaint/edit/{complaint}', [ComplaintController::class, 'edit']);
    // Route::put('/process_complaint/edit/{complaint}', [ComplaintController::class, 'update']);
    Route::get('/process_complaint/detail/{complaint}', [ComplaintController::class, 'detail']);
    // Route::get('/process_complaint/hapus/{complaint}',[ComplaintController::class, 'delete']);

    ## Aduan diterima
    Route::get('/accept_complaint', [ComplaintController::class, 'index']);
    Route::get('/accept_complaint/search', [ComplaintController::class, 'search']);
    // Route::get('/accept_complaint/edit/{complaint}', [ComplaintController::class, 'edit']);
    // Route::put('/accept_complaint/edit/{complaint}', [ComplaintController::class, 'update']);
    Route::get('/accept_complaint/detail/{complaint}', [ComplaintController::class, 'detail']);
    // Route::get('/accept_complaint/hapus/{complaint}',[ComplaintController::class, 'delete']);

    ## Aduan ditolak
    Route::get('/reject_complaint', [ComplaintController::class, 'index']);
    Route::get('/reject_complaint/search', [ComplaintController::class, 'search']);
    Route::get('/reject_complaint/detail/{complaint}', [ComplaintController::class, 'detail']);
    // Route::get('/reject_complaint/hapus/{complaint}',[ComplaintController::class, 'delete']);

    ## Aduan diselesai
    Route::get('/done_complaint', [ComplaintController::class, 'index']);
    Route::get('/done_complaint/search', [ComplaintController::class, 'search']);
    Route::get('/done_complaint/detail/{complaint}', [ComplaintController::class, 'detail']);
    Route::get('/done_complaint/hapus/{complaint}',[ComplaintController::class, 'delete']);

    ## Tracking
    Route::get('/tracking', [TrackingController::class, 'index']);

    ## Grafik
    Route::get('/chart', [ChartController::class, 'index']);
    Route::get('/chart/search', [ChartController::class, 'search']);

    ## Report
    Route::get('/report', [ReportController::class, 'index']);
    Route::post('/report', [ReportController::class, 'download_report']);

    ## Kecamatan
    Route::get('/subdistrict', [SubdistrictController::class, 'index']);
    Route::get('/subdistrict/search', [SubdistrictController::class, 'search']);
    Route::get('/subdistrict/create', [SubdistrictController::class, 'create']);
    Route::post('/subdistrict', [SubdistrictController::class, 'store']);
    Route::get('/subdistrict/edit/{subdistrict}', [SubdistrictController::class, 'edit']);
    Route::put('/subdistrict/edit/{subdistrict}', [SubdistrictController::class, 'update']);
    Route::get('/subdistrict/hapus/{subdistrict}',[SubdistrictController::class, 'delete']);

    ## Kategori
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/search', [CategoryController::class, 'search']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::put('/category/edit/{category}', [CategoryController::class, 'update']);
    Route::get('/category/hapus/{category}',[CategoryController::class, 'delete']);

    ## Puskesmas
    Route::get('/unit', [UnitController::class, 'index']);
    Route::get('/unit/search', [UnitController::class, 'search']);
    Route::get('/unit/create', [UnitController::class, 'create']);
    Route::post('/unit', [UnitController::class, 'store']);
    Route::get('/unit/edit/{unit}', [UnitController::class, 'edit']);
    Route::put('/unit/edit/{unit}', [UnitController::class, 'update']);
    Route::get('/unit/hapus/{unit}',[UnitController::class, 'delete']);

    ## Petugas
    Route::get('/officer', [OfficerController::class, 'index']);
    Route::get('/officer/search', [OfficerController::class, 'search']);
    Route::get('/officer/create', [OfficerController::class, 'create']);
    Route::post('/officer', [OfficerController::class, 'store']);
    Route::get('/officer/edit/{officer}', [OfficerController::class, 'edit']);
    Route::put('/officer/edit/{officer}', [OfficerController::class, 'update']);
    Route::get('/officer/hapus/{officer}',[OfficerController::class, 'delete']);
    Route::get('/officer/get/{unit}',[OfficerController::class, 'get']);
    Route::get('/officer/emergency_request/{user}',[OfficerController::class, 'emergency_request']);
    Route::get('/officer/emergency_detail/{user}/{complaint}',[OfficerController::class, 'emergency_detail']);
    Route::get('/officer/accept/{user}/{complaint}', [OfficerController::class, 'accept']);
    Route::get('/officer/reject/{user}/{complaint}', [OfficerController::class, 'reject']);
    Route::get('/officer/done/{user}/{complaint}', [OfficerController::class, 'done']);

    ## Masyarakat
    Route::get('/citizen', [CitizenController::class, 'index']);
    Route::get('/citizen/search', [CitizenController::class, 'search']);
    Route::get('/citizen/create', [CitizenController::class, 'create']);
    Route::post('/citizen', [CitizenController::class, 'store']);
    Route::get('/citizen/edit/{citizen}', [CitizenController::class, 'edit']);
    Route::put('/citizen/edit/{citizen}', [CitizenController::class, 'update']);
    Route::get('/citizen/hapus/{citizen}',[CitizenController::class, 'delete']);
    Route::get('/citizen/get/{unit}',[CitizenController::class, 'get']);

    ## Ambulans
    Route::get('/ambulance', [AmbulanceController::class, 'index']);
    Route::get('/ambulance/search', [AmbulanceController::class, 'search']);
    Route::get('/ambulance/create', [AmbulanceController::class, 'create']);
    Route::post('/ambulance', [AmbulanceController::class, 'store']);
    Route::get('/ambulance/edit/{ambulance}', [AmbulanceController::class, 'edit']);
    Route::put('/ambulance/edit/{ambulance}', [AmbulanceController::class, 'update']);
    Route::get('/ambulance/hapus/{ambulance}',[AmbulanceController::class, 'delete']);

    ## PSC Call Number
    Route::get('/call_number', [CallNumberController::class, 'index']);
    Route::get('/call_number/search', [CallNumberController::class, 'search']);
    Route::get('/call_number/create', [CallNumberController::class, 'create']);
    Route::post('/call_number', [CallNumberController::class, 'store']);
    Route::get('/call_number/edit/{call_number}', [CallNumberController::class, 'edit']);
    Route::put('/call_number/edit/{call_number}', [CallNumberController::class, 'update']);
    Route::get('/call_number/hapus/{call_number}',[CallNumberController::class, 'delete']);

    ## Pengumuman
    Route::get('/announcement', [AnnouncementController::class, 'index']);
    Route::get('/announcement/search', [AnnouncementController::class, 'search']);
    Route::get('/announcement/create', [AnnouncementController::class, 'create']);
    Route::post('/announcement', [AnnouncementController::class, 'store']);
    Route::get('/announcement/edit/{announcement}', [AnnouncementController::class, 'edit']);
    Route::put('/announcement/edit/{announcement}', [AnnouncementController::class, 'update']);
    Route::get('/announcement/hapus/{announcement}',[AnnouncementController::class, 'delete']);

    ## Group
    Route::get('/group', [GroupController::class, 'index']);
    Route::get('/group/search', [GroupController::class, 'search']);
    Route::get('/group/create', [GroupController::class, 'create']);
    Route::post('/group', [GroupController::class, 'store']);
    Route::get('/group/edit/{group}', [GroupController::class, 'edit']);
    Route::put('/group/edit/{group}', [GroupController::class, 'update']);
    Route::get('/group/hapus/{group}',[GroupController::class, 'delete']);

    ## Menu
    Route::get('/menu/', [MenuController::class, 'index']);
    Route::get('/menu/search', [MenuController::class, 'search']);
    Route::get('/menu/create', [MenuController::class, 'create']);
    Route::post('/menu', [MenuController::class, 'store']);
    Route::get('/menu/edit/{menu}', [MenuController::class, 'edit']);
    Route::put('/menu/edit/{menu}', [MenuController::class, 'update']);
    Route::get('/menu/hapus/{menu}',[MenuController::class, 'delete']);

    ## User
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/search', [UserController::class, 'search']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user/edit/{user}', [UserController::class, 'edit']);
    Route::put('/user/edit/{user}', [UserController::class, 'update']);
    Route::get('/user/hapus/{user}',[UserController::class, 'delete']);

    ## Log Activity
    Route::get('/log', [LogController::class, 'index']);
    Route::get('/log/search', [LogController::class, 'search']);

});

Route::middleware(['cek_status'])->group(function () {
    
    
    Route::get('/count_complaint/all', [ComplaintController::class, 'count_data']);
    Route::get('/count_complaint/request', [ComplaintController::class, 'count_data']);
    Route::get('/count_complaint/process', [ComplaintController::class, 'count_data']);
    Route::get('/count_complaint/accept', [ComplaintController::class, 'count_data']);

    ## Penanganan
    Route::get('/handling/{complaint}', [HandlingController::class, 'edit']);
    Route::put('/handling/{complaint}', [HandlingController::class, 'update']);

    ## Detail Tracking
    Route::get('/detail_tracking/{complaint}', [TrackingController::class, 'detail']);
    Route::get('/detail_tracking2/{complaint}', [TrackingController::class, 'detail2']);

    ## Kelurahan
    Route::get('/village/{subdistrict}', [VillageController::class, 'index']);
    Route::get('/village/search/{subdistrict}', [VillageController::class, 'search']);
    Route::get('/village/create/{subdistrict}', [VillageController::class, 'create']);
    Route::post('/village/{subdistrict}', [VillageController::class, 'store']);
    Route::get('/village/edit/{subdistrict}/{village}', [VillageController::class, 'edit']);
    Route::put('/village/edit/{subdistrict}/{village}', [VillageController::class, 'update']);
    Route::get('/village/hapus/{subdistrict}/{village}',[VillageController::class, 'delete']);

    ## Tindakan
    Route::get('/treatment/{category}', [TreatmentController::class, 'index']);
    Route::get('/treatment/search/{category}', [TreatmentController::class, 'search']);
    Route::get('/treatment/create/{category}', [TreatmentController::class, 'create']);
    Route::post('/treatment/{category}', [TreatmentController::class, 'store']);
    Route::get('/treatment/edit/{category}/{treatment}', [TreatmentController::class, 'edit']);
    Route::put('/treatment/edit/{category}/{treatment}', [TreatmentController::class, 'update']);
    Route::get('/treatment/hapus/{category}/{treatment}',[TreatmentController::class, 'delete']);

    ## Layanan
    Route::get('/unit_service/{category}', [UnitServiceController::class, 'index']);
    Route::get('/unit_service/search/{category}', [UnitServiceController::class, 'search']);
    Route::get('/unit_service/create/{category}', [UnitServiceController::class, 'create']);
    Route::post('/unit_service/{category}', [UnitServiceController::class, 'store']);
    Route::get('/unit_service/edit/{category}/{unit_service}', [UnitServiceController::class, 'edit']);
    Route::put('/unit_service/edit/{category}/{unit_service}', [UnitServiceController::class, 'update']);
    Route::get('/unit_service/hapus/{category}/{unit_service}',[UnitServiceController::class, 'delete']);

    ## Sub Menu
    Route::get('/sub_menu/{id}', [SubMenuController::class, 'index']);
    Route::get('/sub_menu/search/{id}', [SubMenuController::class, 'search']);
    Route::get('/sub_menu/create/{id}', [SubMenuController::class, 'create']);
    Route::post('/sub_menu/{id}', [SubMenuController::class, 'store']);
    Route::get('/sub_menu/edit/{id}/{sub_menu}', [SubMenuController::class, 'edit']);
    Route::put('/sub_menu/edit/{id}/{sub_menu}', [SubMenuController::class, 'update']);
    Route::get('/sub_menu/hapus/{id}/{sub_menu}',[SubMenuController::class, 'delete']);

    ## Menu Akses
    Route::get('/menu_akses/{group}', [MenuAccessController::class, 'index']);
    Route::get('/menu_akses/search/{group}', [MenuAccessController::class, 'search']);
    Route::get('/menu_akses/create/{group}', [MenuAccessController::class, 'create']);
    Route::post('/menu_akses/{group}', [MenuAccessController::class, 'store']);
    Route::get('/menu_akses/edit/{group}/{menu_access}', [MenuAccessController::class, 'edit']);
    Route::put('/menu_akses/edit/{group}/{menu_access}', [MenuAccessController::class, 'update']);
    Route::get('/menu_akses/hapus/{group}/{menu_access}',[MenuAccessController::class, 'delete']);

    ## Sub Menu Akses
    Route::get('/sub_menu_akses/{group}/{menu}', [SubMenuAccessController::class, 'index']);
    Route::get('/sub_menu_akses/search/{group}/{menu}', [SubMenuAccessController::class, 'search']);
    Route::get('/sub_menu_akses/create/{group}/{menu}', [SubMenuAccessController::class, 'create']);
    Route::post('/sub_menu_akses/{group}/{menu}', [SubMenuAccessController::class, 'store']);
    Route::get('/sub_menu_akses/edit/{group}/{menu}/{sub_menu_access}', [SubMenuAccessController::class, 'edit']);
    Route::put('/sub_menu_akses/edit/{group}/{menu}/{sub_menu_access}', [SubMenuAccessController::class, 'update']);
    Route::get('/sub_menu_akses/hapus/{group}/{menu}/{sub_menu_access}',[SubMenuAccessController::class, 'delete']);

    ## Setting
    Route::get('/setting', [SettingController::class, 'index']);
    Route::put('/setting/edit/{setting}', [SettingController::class, 'update']);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/privacypolicy', [PrivacyPoliceController::class, 'index'])->name('privacypolicy');
