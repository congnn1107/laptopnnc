<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $table = "promotion";
    protected $fillable = [
        "title", "content"
    ];

    public function detail(){
        return $this->hasMany("App\Model\PromotionProduct");
    }
}
