<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    //
    use SoftDeletes;
    protected $table="slider";
    protected $fillable = [
        "image","url","status",'type', 'position'
    ];

    
}
