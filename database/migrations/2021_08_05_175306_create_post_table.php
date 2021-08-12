<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("title");
            $table->string("slug");
            $table->mediumText("content");
            $table->string("cover_image");
            $table->string("meta_keyword");
            $table->string("meta_description");
            $table->unsignedBigInteger("author");
            $table->integer("view")->default(0);
            $table->integer("status")->default(0);//0=draff,1= saved, 2 = published, 3 = deleted
            $table->timestamps();

            //foreign_key
            // $table->foreign("author")->references("id")->on("admin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
