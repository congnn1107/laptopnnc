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
            $table->mediumText("content")->nullable();
            $table->string("cover_image")->nullable();
            $table->string("meta_keyword")->nullable();
            $table->text("meta_description")->nullable();
            $table->unsignedBigInteger("author");
            $table->integer("view")->default(0);
            $table->integer("status")->default(0);//0=draff,1= saved, 2 = published
            $table->timestamps();
            $table->softDeletes();
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
