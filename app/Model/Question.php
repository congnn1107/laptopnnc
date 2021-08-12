<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table="question";
    protected $fillable = [
        "email","name","comment","reply_for","product"
    ];
    public function product(){
        return $this->belongsTo("App\Model\Product","product");
    }
    public function admin(){
        return $this->belongsTo("App\Model\Admin","name","name");
    }
    public function user(){
        return $this->belongsTo("App\Model\User","email","email");
    }
}
