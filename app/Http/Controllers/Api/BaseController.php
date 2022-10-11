<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public static $INVALID_TOKEN = 0;
    public static $EXPIRED_TOKEN = 1;
    public static $VALID_TOKEN = 2;
    
    protected $id = [
        "auth_fe_data" => [
            "login"                   => "Masuk",
            "register"                => "Registrasi",
		"change_language"		  => "Ganti Bahasa",	
            "skip"                    => "Lewati",
            "explore_baubau"          => "Jelajahi Baubau",
            "intro_text"              => "Lorem ipsum sir dolor amet dudui esketit rede defaoefaefae efoefwep",
            "register_intro_text"     => "Masukkan data anda sesuai form dibawah.",
            "make_account"            => "Buat Akun",
            "already_have_an_account" => "Sudah punya akun?" ,
            "email"                   => "Email",
		"name"			  => "nama",
            "password"                => "Password",
		"forget_password"		  => "Lupa password?",	
		"forget_text"		  => "Masukkan email yang anda gunakan.",
            "confirm_password"        => "Konfirmasi password",
		"password_mismatch"       => "Konfirmasi password salah.",
            "gender"                  => "Jenis Kelamin",
            "age"                     => "Umur",
            "confirm"                 => "Konfirmasi"
        ],
        "dashboard_fe_data" => [
            "time_greeting"      => "Hai",
            "where_today"        => "Kemana Hari Ini?",
            "search_destination" => "Cari destinasi",
            "accomodation"       => "Akomodasi",
            "travel_agent"       => "Agen Tour/Travel",
            "event"              => "Event",
            "culinary"           => "Kuliner",
            "rent_vehicle"       => "Sewa Kendaraan",
            "hospital"           => "Rumah Sakit",
            "marketplace"        => "Pasar/Swalayan",
            "money_changer"      => "Pertukaran Uang",
            "transportation"     => "transportasi",
		"public_service"	   => "Pelayanan Publik",		
            "open_tour_map"      => "Buka Peta Wisata",
        ],
        "content_fe_data" => [
            "list"            => "Daftar",
            "search"          => "Cari",
            "detail"          => "Detail",
            "contact"         => "Contact",
            "navigation"      => "Navigasi",
            "open_google_map" => "Buka Google Map"
        ],
        "review_fe_data" => [
            "review"        => "Tinjauan",
            "all_review"    => "Lihat semua tinjauan",
            "write_review"  => "Tulis tinjauan",
            "write_comment" => "Tulis komentar",
            "averages"      => "Rata-rata dari",
            "cancel"        => "Batal",
            "confirm"       => "Konfirmasi"
        ],
        "tour_destination_fe_data" => [
            "tour_destination"        => "Destinasi Wisata",
            "search_tour_destination" => "Cari destinasi wisata",
            "beach"                   => "Pantai",
            "great_view"              => "Saujana",
            "tourist_forest"          => "Hutan Wisata",
            "religion"                => "Religi",
            "historical_site"         => "Peninggalan Sejarah",
            "aquatic_site"            => "Perairan",
            "photo_site"              => "Spot Foto"
        ],
	  "settings_fe_data" => [
        	"settings"		=> "Pengaturan",
		"profile"		=> "Profil",
		"profile_desc"	=> "Lihat atau edit profil anda.",
		"language"		=> "Bahasa",
		"language_desc"	=> "Ganti translasi bahasa aplikasi",
		"log_out"		=> "Keluar dari akun",
	  ]
    ];

    protected $en = [
        "auth_fe_data" => [
            "login"                   => "Login",
            "register"                => "Register",
		"change_language"		  => "Change Language",	
            "skip"                    => "Skip",
            "explore_baubau"          => "Explore Baubau",
            "intro_text"              => "Lorem ipsum sir dolor amet dudui esketit rede defaoefaefae efoefwep",
            "register_intro_text"     => "Enter your data according to the form below.",
            "make_account"            => "Create Account",
            "already_have_an_account" => "Already have an account?" ,
            "email"                   => "Email",
		"name"			  => "Name",
            "password"                => "Password",
		"forget_password"		  => "Forget password?",	
		"forget_text"		  => "Enter the email you use.",
            "confirm_password"        => "Confirm password",
		"password_mismatch"       => "Password confirmation mismatch.",
            "gender"                  => "Gender",
            "age"                     => "Age",
            "confirm"                 => "Confirm"
        ],
        "dashboard_fe_data" => [
            "time_greeting"      => "Hello",
            "where_today"        => "Where are you going today?",
            "search_destination" => "Search destination",
            "accomodation"       => "Accomodation",
            "travel_agent"       => "Tour/Travel Agent",
            "event"              => "Event",
            "culinary"           => "Culinary",
            "rent_vehicle"       => "Rent Vehicle",
            "hospital"           => "Hospital",
            "marketplace"        => "Marketplace",
            "money_changer"      => "Money Changer",
            "transportation"     => "Transportation",
		"public_service"	   => "Public Service",		
            "open_tour_map"      => "Tour Map",
        ],
        "content_fe_data" => [
            "list"            => "List",
            "search"          => "Search",
            "detail"          => "Detail",
            "contact"         => "Contact",
            "navigation"      => "navigation",
            "open_google_map" => "Open Google Map"
        ],
        "review_fe_data" => [
            "review"        => "Review",
            "all_review"    => "All Review",
            "write_review"  => "Write Review",
            "write_comment" => "Write Comment",
            "averages"      => "Averages from",
            "cancel"        => "Cancel",
            "confirm"       => "Confirm"
        ],
        "tour_destination_fe_data" => [
            "tour_destination"        => "Tour Destination",
            "search_tour_destination" => "Search Destination",
            "beach"                   => "Beach",
            "great_view"              => "Views",
            "tourist_forest"          => "Tourist Forest",
            "religion"                => "Religion",
            "historical_site"         => "Historical Site",
            "aquatic_site"            => "Aquatic Site",
            "photo_site"              => "Photo Site"
        ],
	  "settings_fe_data" => [
        	"settings"		=> "Settings",
		"profile"		=> "Profile",
		"profile_desc"	=> "Look and edit your profile.",
		"language"		=> "Language",
		"language_desc"	=> "Change app translation.",
		"log_out"		=> "Sign out",
	  ]
    ];


    /**
     * TOKEN AREA
     */


     /**
     * Check Expiration Token
     * 
     * @param mixed $user
     */
    public function checkExpirationToken($expiredDate)
    {
        $validity = strtotime($expiredDate) - time();
        return ($validity < 0) ? true : false;
    }

    /**
     * Check Expiration Token
     * 
     * @param mixed $user
     */
    public function updateToken($user)
    {
        if ($this->checkExpirationToken($user->api_expired) == true) {
            $user->api_token    = Str::random(36);
            $user->api_expired  = date('Y-m-d H:i:s', strtotime('+1 weeks', strtotime(date('Y-m-d H:i:s'))));
            $user->save();
        }
    }


    public function confirmToken($request)
    {
        // $user = User::where('email' , $request->email)->where('api_token', $request->header('token'))->first();
        $user = User::where('api_token', $request->header('token'))->first();
        
        if (is_null($user)) {
            return self::$INVALID_TOKEN;
        } else {
            return ($this->checkExpirationToken($user->api_expired) == true) ?
                self::$EXPIRED_TOKEN : self::$VALID_TOKEN;
        }
    }
    
    // send response
    public function sendResponse($result, $message, $lang = 'id')
    {
        $resposnse = [
            'status'  => true,
            'lang'    => $lang ?? 'id',
            'message' => $message,
            'data'    => $result ?? [],
        ];

        return response()->json($resposnse, 200);
    }

    // send error
    public function sendError($error, $errorMessage = [], $code = 404, $lang = 'id')
    {
        $resposnse = [
            'status' => false,
            'lang' => $lang ?? 'id',
            // 'message' => $errorMessage ?? [],
            'message' => $error,
            'data' => null
        ];

        if (!empty($errorMessage)) {
            $errorMessage = json_encode($errorMessage['error']);
            $error = json_decode($errorMessage);
            $resposnse['data'] = explode(".",$error);
            
        }

        return response()->json($resposnse ?? []);
    }

    // send error
    public function sendError2($error, $errorMessage = [], $code = 404, $lang = 'id')
    {
        $resposnse = [
            'status' => false,
            'lang' => $lang ?? 'id',
            // 'message' => $errorMessage ?? [],
            'message' => $error,
            'data' => null
        ];

        if (!empty($errorMessage)) {

            ## 
            $errorMessage = json_encode($errorMessage['error']);
            $error = json_decode($errorMessage);
            
            $result = "";
            $total = 0;
            $total2 = 0;

            foreach($error as $t => $v) 
            {
                $total = $total+1;                                                  
            }

            foreach($error as $t => $v) 
            {
                $total2 = $total2+1;  
                if ($total2 == $total){
                    $result .= $v[0];
                } else {
                    $result .= $v[0].",";
                }  
            }

            $resposnse['data'] = explode(",",$result);
        }

        return response()->json($resposnse ?? []);
    }

    

}
