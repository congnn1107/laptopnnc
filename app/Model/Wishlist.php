<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $table ='wishlist';
    protected $fillable = [
        'user','product'
    ];
    public function getProduct(){
        return $this->hasOne('App\Model\Product','id','product')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('App\Model\User','user');
    }
}
