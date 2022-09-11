<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'officer_id',
        'unit_id'
    ];

    public function officer(){
        return $this->belongsTo('\App\Models\Officer');
    }

    public function unit(){
        return $this->belongsTo('\App\Models\Unit');
    }
}
