<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //
    use SoftDeletes;
    protected $table = 'admin';

    protected $fillable =[
        "name","username","password","email"
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
