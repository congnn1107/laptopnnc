<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('order_code')->unique();
            $table->integer("status")->default(1);//0 = đã hủy, 1 = chờ xác nhận, 2 = đã xác nhận, 3 = đang giao hàng, 4 = đã giao hàng, 5 = đã xóa
            $table->unsignedBigInteger("customer");
            $table->string("address")->nullable();
            $table->unsignedBigInteger("admin")->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            //foreign key
            // $table->foreign("customer")->references("id")->on("customer");
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
        Schema::dropIfExists('order');
    }
}
