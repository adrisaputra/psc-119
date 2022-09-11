<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone_number',
        'address',
        'status',
        'unit_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

}
