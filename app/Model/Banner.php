<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    //
    use SoftDeletes;
    protected $table="banner";
    protected $fillable=[
        "image","url","position",
        "status"
    ];
}
