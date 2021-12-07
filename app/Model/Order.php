<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;
    protected $table="order";
    protected $fillable=["customer","admin","address","status",'order_code'];

    public function detail(){
        return $this->hasMany("App\Model\OrderDetail","order");
    }

    public function customer(){
        return $this->belongsTo("App\Model\Customer","customer");
    }
}
