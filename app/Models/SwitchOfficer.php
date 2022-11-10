<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwitchOfficer extends Model
{
    use HasFactory;

    protected $fillable =[
        'complaint_id',
        'description',
        'unit_id',
        'officer_id',
    ];

    public function complaint(){
        return $this->belongsTo('App\Models\Complaint');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function officer()
    {
        return $this->belongsTo('App\Models\Officer');
    }
}
