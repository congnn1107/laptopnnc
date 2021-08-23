<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    //
    use SoftDeletes;
    protected $table="product_price";
    protected $fillable=[
        "product","import_price","sell_price"
    ];
}
