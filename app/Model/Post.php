<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $table = "post";
    protected $fillable = [
        "title","slug","content","cover_image",
        "meta_keyword","meta_description",
        "author","views","status"
    ];

    public function author(){
        return $this->belongsTo("App\Model\Admin","author")->withTrashed();
    }
}
