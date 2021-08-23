<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("name")->unique();
            $table->string("slug")->unique();
            $table->string("card_image");
            $table->string("sku")->unique();
            $table->integer("memory_slots");
            $table->string("memory_type");
            $table->string("memory_capacity");
            $table->string("ssd_storage");
            $table->integer("ssd_capacity");
            $table->string("hdd_storage");
            $table->integer("hdd_capacity");
            $table->integer("cpu");
            $table->integer("gpu");
            $table->string("screen_type");
            $table->integer("screen_size");
            $table->string("screen_detail");
            $table->string("case_material");
            $table->string("bluetooth");
            $table->string("wifi");
            $table->string("connection_jacks");
            $table->string("key_board");
            $table->string("addition");
            $table->string("operating_system");
            $table->mediumText("describe");
            $table->unsignedBigInteger("status")->default(3);
            $table->timestamps();
            $table->softDeletes();

            //$foreign key
            // $table->foreign("cpu")->references("id")->on("cpu");
            // $table->foreign("gpu")->references("id")->on("gpu");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
