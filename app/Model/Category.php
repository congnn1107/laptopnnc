<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
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

    public function getList(){

        //code

        return $this->list;
    }
}
