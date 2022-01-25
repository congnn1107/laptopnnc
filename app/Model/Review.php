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
        "email","product","title",
        "content","points","name"
    ];
    public function product(){
        return $this->belongsTo("App\Model\Product","product","id");
    }
}
