<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    //
    use SoftDeletes;
    protected $table="discount";
    protected $fillable=[
        "title","content","discounted_rate"
    ];

    function detail(){
        return $this->hasMany("App\Model\DiscountedProduct","discount");
    }
}
