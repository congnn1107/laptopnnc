<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GPU extends Model
{
    //
    use SoftDeletes;
    protected $table = "gpu";
    protected $fillable = [
        "series","name","graph_memory_cap",
        "clock","release_date","branch",
        "addition"
    ];

    public function product(){
        return $this->hasMany("App\Model\Product","gpu");
    }
}
