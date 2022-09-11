<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handling extends Model
{
    use HasFactory;

    protected $fillable =[
        'complaint_id',
        'diagnosis',
        'handling',
        'response_time',
        'done_time',
        'status',
        'user_id',
    ];

    public function complaint(){
        return $this->belongsTo('App\Models\Complaint');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
