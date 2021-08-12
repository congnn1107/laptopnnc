<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table="role";
    protected $fillable=[
        "name"
    ];

    public function admin(){
        return $this->hasMany("App\Model\Admin","role");
    }
}
