<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;
    protected $table = "review";
    protected $fillable = [
        "customer_phone","product","title",
        "content","points"
    ];
    public function product(){
        return $this->belongsTo("App\Model\Product","product","id");
    }
}
