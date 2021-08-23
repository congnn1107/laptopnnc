<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger("product");
            $table->string("emei");
            $table->dateTime("sold_at")->useCurrent();
            $table->integer("status")->default(0);//0 = inactivated; 1= activated
            $table->string("customer_phone");
            $table->string("customer_email");
            $table->dateTime("actived_at")->nullable();
            $table->dateTime("expired");
            $table->string("info");
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
        Schema::dropIfExists('warranty');
    }
}
