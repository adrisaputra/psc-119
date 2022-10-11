<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
	protected $fillable =[
        'name',
        'address',
        'coordinate',
        'category',
        'image',
        'time_operation',
        'subdistrict_id'
    ];
    
    public function subdistrict()
    {
        return $this->belongsTo('App\Models\Subdistrict');
    }
    
    public function unit_service()
    {
        return $this->belongsTo('App\Models\UnitService');
    }
    
    public function officer()
    {
        return $this->hasOne('App\Models\Officer');
    }
    
    public function complaint()
    {
        return $this->hasOne('App\Models\Complaint');
    }
    
    public function switch_officer()
    {
        return $this->hasOne('App\Models\SwitchOfficer');
    }
    
}
