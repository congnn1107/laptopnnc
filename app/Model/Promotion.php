<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    //
    use SoftDeletes;
    protected $table = "promotion";
    protected $fillable = [
        "title", "content","expired_at"
    ];

    public function detail(){
        return $this->hasMany("App\Model\PromotionProduct",'promotion');
    }
}
