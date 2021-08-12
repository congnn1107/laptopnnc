<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $table="product_category";
    protected $fillable=[
        "product","category"
    ];
    public function product(){
        return $this->hasMany("App\Model\Product","product","id");
    }
    public function category(){
        return $this->belongsTo("App\Model\Category","category","id");
    }
}
