<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PromotionProduct extends Model
{
    //
    protected $table = "promotion_product";
    protected $fillable = [
        "promotion","product"
    ];
    public function product(){
        return $this->belongsTo("App\Model\Product","product","id");
    }
    public function promotion(){
        return $this->belongsTo("App\Model\Product","product","id");
    }
}
