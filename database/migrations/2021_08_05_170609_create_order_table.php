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
            $table->integer("status")->default(0);//4 = đã hủy, 0 = chờ xác nhận, 1 = đã xác nhận, 2 = đang giao hàng, 3 = đã giao hàng, 5 = đã xóa
            $table->unsignedBigInteger("customer");
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->unsignedBigInteger("admin")->nullable()->default(1);
            $table->dateTime('finished_at')->nullable();
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
