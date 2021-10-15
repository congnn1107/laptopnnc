<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class WarrantyLog extends Model
{
    //
    protected $table='warranty_log';
    protected $fillable=[
        'id','warranty_id','problem','product_condition',
        'receive_at','return_at','cost'
    ];

    public function warranty(){
        return $this->belongsTo('App\Model\Warranty','warranty_id');
    }
}
