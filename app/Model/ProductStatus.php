<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    //
    protected $table="product_status";
    protected $fillable = [
        "name"
    ];
}
