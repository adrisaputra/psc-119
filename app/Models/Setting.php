<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
	protected $fillable =[
        'application_name',
        'short_application_name',
        'small_icon',
        'large_icon',
        'background_login',
        'background_sidebar',
        'gmaps_key',
        'psc_call_number',
        'psc_call_number_description',
        'time_refresh_tracking',
        'layout',
        'skin',
        'user_id'
    ];
}
