<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger("order");
            $table->unsignedBigInteger("product");
            $table->integer("quantity",false,true)->default(0);
            $table->double("price",false,true)->default(0);
            $table->double("discounted",false,true)->default(0);
            $table->double("final_price",false,true)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
