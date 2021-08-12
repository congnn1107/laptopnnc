<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DiscountedProduct extends Model
{
    //
    protected $table = "discounted_product";
    protected $fillable = [
        "discount","product","quantity"
    ];
    public function product(){
        return $this->belongsTo("App\Model\Product","product","id");
    }
    public function discount(){
        return $this->belongsTo("App\Model\Discount","discount","id");
    }
}
