<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = "post";
    protected $fillable = [
        "title","slug","content","cover_image",
        "meta_keyword","meta_description",
        "author","views","status"
    ];

    public function author(){
        return $this->belongsTo("App\Model\Admin","author");
    }
}
