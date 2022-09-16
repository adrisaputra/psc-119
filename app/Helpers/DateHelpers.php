<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class DateHelpers
{
    
    public static function day($day)
    {
        switch($day){
            case "Mon" : $hari = "Senin";break;
            case "Tue" : $hari = "Selasa";break;
            case "Wed" : $hari = "Rabu";break;
            case "Thu" : $hari = "Kamis";break;
            case "Fri" : $hari = "Jum'at";break;
            case "Sat" : $hari = "Sabtu";break;
            case "Sun" : $hari = "Minggu";break;
        }
        return $hari;
    }

    public static function month($month)
    {
        switch($month){
            case 1 : $bulan = "Januari";break;
            case 2 : $bulan = "Februari";break;
            case 3 : $bulan = "Maret";break;
            case 4 : $bulan = "April";break;
            case 5 : $bulan = "Mei";break;
            case 6 : $bulan = "Juni";break;
            case 7 : $bulan = "Juli";break;
            case 8 : $bulan = "Agustus";break;
            case 9 : $bulan = "September";break;
            case 10 : $bulan = "Oktober";break;
            case 11 : $bulan = "November";break;
            case 12 : $bulan = "Desember";break;
        }
        return $bulan;
    }

}
