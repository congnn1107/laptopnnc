<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $table="discount";
    protected $fillable=[
        "title","content","discounted_rate"
    ];

    function detail(){
        return $this->hasMany("App\Model\DiscountedProduct","discount");
    }
}
