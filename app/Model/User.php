<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    //
    use SoftDeletes;
    protected $table = "user";
    protected $fillable= [
        "name","birthday","gender",
        "address","email","phone",
        "avatar","password"
    ];

    protected $hidden = [
        "password"
    ];
    public function customer(){
        return $this->hasMany("App\Model\Customer","email","email");
    }
}
