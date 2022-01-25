<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    //
    use SoftDeletes;
    protected $table="warranty";
    protected $fillable = [
        "product","emei","sold_at",
        "status","customer_phone","customer_email",
        "activated_at","expired",'info'
    ];
    function products(){
        return $this->belongsTo("App\Model\Product","product","id")->withTrashed();
    }
    function customer(){
        return $this->belongsTo("App\Model\Customer","customer_phone","phone")->withTrashed();
    }
    function user(){
        return $this->belongsTo("App\Model\User","customer_phone","phone")->withTrashed();
    }
    function logs(){
        return $this->hasMany('App\Model\WarrantyLog','warranty_id');
    }
    
}
