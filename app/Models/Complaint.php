<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'ticket_number',
        'phone_number',
        'name',
        'incident_area',
        'summary',
        'category_id',
        'psc',
        'status',
        'unit_id',
        'coordinate_citizen',
        'coordinate_officer',
        'image',
        'photo_citizen',
        'description',
        'reason',
        'report_type',
        'handling_status',
        'reference_place'
    ];
    
    public function getIncrementing()
    {
        return false;
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    
    public function handling(){
        return $this->hasOne('App\Models\Handling');
    }
    
    public function switch_officer(){
        return $this->hasOne('App\Models\SwitchOfficer');
    }
    
}
