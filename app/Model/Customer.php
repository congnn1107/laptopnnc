<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes;
    protected $table = "customer";
    protected $fillable = [

        "name","address","phone","email"
    ];


    public function order(){
        return $this->hasMany("App\Model\Order","customer")->withTrashed();
    }

    /**
     * Trả ra User có email trùng với email của customer
     * @return null|User
     */
    public function user(){
        return $this->belongsTo("App\Model\User","email","email");
    }
    public function warranty(){
        return $this->hasMany("App\Model\Warranty","customer_phone","phone");
    }
}
