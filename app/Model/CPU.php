<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPU extends Model
{
    //
    use SoftDeletes;
    protected $table="cpu";
    protected $fillable=[
        "series","name","gen",
        "cores", "threads","base_clock",
        "turbo_clock","cache","release_date",
        "brand"
    ];

    public function product(){
        return $this->hasMany("App\Model\Product","cpu");
    }
}
