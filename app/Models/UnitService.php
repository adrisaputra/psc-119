<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitService extends Model
{
    use HasFactory;
    protected $fillable =[
        'service',
        'description',
        'unit_id'
    ];

    
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
}
