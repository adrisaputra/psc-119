<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	protected $fillable =[
        'name',
        'image',
        'text'
    ];

    public function treatment()
    {
        return $this->hasOne('App\Models\Category');
    }

    public function complaint()
    {
        return $this->hasOne('App\Models\Complaint');
    }

}
