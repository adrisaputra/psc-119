<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
	protected $fillable =[
        'name',
        'subdistrict_id'
    ];

    
    public function subdistrict()
    {
        return $this->belongsTo('App\Models\Subdistrict');
    }
}
