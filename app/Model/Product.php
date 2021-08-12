<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";
    protected $fillable =[
        "name","slug","card_image",
        "sku","memory_slot","memory_type",
        "memory_capacity","ssd_storage","ssd_capacity",
        "hdd_storage","hdd_capacity","cpu",
        "gpu","screen_type","screen_size",
        "screen_detail","case_material",
        "bluetooth","wifi","connection_jacks",
        "keyboard","addition","battery",
        "color","operating_system","describe",
        "status"
    ];

    public function cpu(){
        return $this->belongsTo("App\Model\CPU","cpu");
    }
    public function gpu(){
        return $this->belongsTo("App\Model\GPU","gpu");
    }
    public function status(){
        return $this->belongsTo("App\Model\ProductStatus","status");
    }
    public function images(){
        return $this->hasMany("App\Model\ProductImage","product");
    }
    public function price(){
        return $this->hasOne("App\Model\ProductPrice","product");
    }
    public function quantity(){
        return $this->hasOne("App\Model\ProductStock","product");
    }
    public function discount(){
        return $this->hasManyThrough("App\Model\Discount","App\Model\DiscountedProduct","product","id");
    }
    public function promotion(){
        return $this->hasManyThrough("App\Model\Promotion","App\Model\PromotionProduct","product","id");
    }
    public function review(){
        return $this->hasMany("App\Model\Review","product");
    }
    public function question(){
        return $this->hasMany("App\Model\Question","product");
    }
}
