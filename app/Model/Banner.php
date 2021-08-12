<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table="banner";
    protected $fillable=[
        "image","url","position",
        "status"
    ];
}
