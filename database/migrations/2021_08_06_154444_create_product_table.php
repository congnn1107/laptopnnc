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
            $table->string("card_image")->nullable();
            $table->string("sku")->unique();
            $table->string("memory");
            $table->string("memory_capacity");
            $table->string("ssd_storage")->nullable();
            $table->string("ssd_capacity")->nullable();
            $table->string("hdd_storage")->nullable();
            $table->string("hdd_capacity")->nullable();
            $table->unsignedBigInteger("cpu")->nullable();
            $table->unsignedBigInteger("gpu")->nullable();
            $table->string("screen_type")->nullable();
            $table->string("screen_size")->nullable();
            $table->string("screen_detail")->nullable();
            $table->string("case_material")->nullable();
            $table->string('webcam')->nullable();
            $table->string("bluetooth")->nullable();
            $table->string("wifi")->nullable();
            $table->string("connection_port")->nullable();
            $table->string("keyboard")->nullable();
            $table->string("battery")->nullable();
            $table->string("color")->nullable();
            $table->string("addition")->nullable();
            $table->string("operating_system")->nullable();
            $table->mediumText("describe")->nullable();
            $table->unsignedBigInteger("status")->nullable()->default(3);
            $table->double('import_price')->nullable();
            $table->double('sell_price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('package')->nullable();
            $table->string('warranty_time')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product');
    }
}
