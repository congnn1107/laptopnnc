<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    //
    protected $table = "product_stock";
    protected $fillable = [
        "product","quantity"
    ];
}
