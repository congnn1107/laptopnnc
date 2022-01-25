<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    //
    use SoftDeletes;
    protected $table="order_detail";
    protected $fillable=[
        "order","product",'discounted',
        "quantity","price",'final_price'
    ];

    public function product(){
        return $this->hasMany("App\Model\Product","id","product")->withTrashed();
    }
    public function customer(){
        return $this->belongsTo("App\Model\Customer","customer");
    }
}
