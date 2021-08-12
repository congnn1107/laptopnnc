<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table="order_detail";
    protected $fillable=[
        "order","customer","product",
        "quantity","price"
    ];

    public function product(){
        return $this->hasMany("App\Model\Product","id","product");
    }
    public function customer(){
        return $this->belongsTo("App\Model\Customer","customer");
    }
}
