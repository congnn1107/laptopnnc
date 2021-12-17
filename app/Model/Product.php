<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $table = "product";
    protected $fillable =[
        "name","slug","card_image",
        "sku","memory",
        "memory_capacity","ssd_storage","ssd_capacity",
        "hdd_storage","hdd_capacity","cpu",
        "gpu","screen_type","screen_size",
        "screen_detail","case_material",
        "bluetooth","wifi","connection_port",
        "keyboard","addition","battery",
        "color","operating_system","describe",
        "status", "import_price","sell_price","stock","size",
        "weight","warranty_time","package",
        'webcam'
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

    public function stock(){
        return $this->hasMany("App\Model\ProductStock","product");
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
    public function categories(){
        return $this->hasManyThrough('App\Model\Category',"App\Model\ProductCategory","product","id","id","category");
    }
}
