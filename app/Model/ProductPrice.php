<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    //
    protected $table="product_price";
    protected $fillable=[
        "product","import_price","sell_price"
    ];
}
