<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CPU extends Model
{
    //
    protected $table="cpu";
    protected $fillable=[
        "series","name","gen",
        "cores", "threads","base_clock",
        "turbo_clock","cache","release_date",
        "branch"
    ];

    public function product(){
        return $this->hasMany("App\Model\Product","cpu");
    }
}
