<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionProduct extends Model
{
    //
    use SoftDeletes;
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
