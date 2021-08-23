<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    //
    use SoftDeletes;
    protected $table = "product_stock";
    protected $fillable = [
        "product","quantity"
    ];
}
