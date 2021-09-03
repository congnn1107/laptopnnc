<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    private $list = [];
    protected $table = "category";
    protected $fillable = [
        "name","parent_id","level"
    ];
    /**
     * TODO:
     * get products list of a category throught product_category table
     * get list of categories by descending order
     */


    public function product(){
        return $this->hasManyThrough("App\Model\Product","App\Model\ProductCategory","category","id");
    }
    public function parent(){
        return $this->belongsTo("App\Model\Category","parent_id");
    }
    public function childs(){
        return $this->hasMany("App\Model\Category","parent_id");
    }
}
