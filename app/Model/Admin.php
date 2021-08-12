<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admin';

    protected $fillable =[
        "name","username","password"
    ];
    protected $hidden =[
        "password"
    ];

    public function role(){
        return $this->belongsTo("App\Model\Role","role","id");
    }
    public function post(){
        return $this->hasMany("App\Model\Post","author");
    }
}
