<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table="order";
    protected $fillable=["customer"];

    public function detail(){
        return $this->hasMany("App\Model\OrderDetail","order");
    }

    public function customer(){
        return $this->belongsTo("App\Model\Customer","customer");
    }
}
