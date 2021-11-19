<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("title");
            $table->text("content");
            $table->integer('type')->default(1);
            $table->double("discounted_rate")->nullable()->default(0);
            $table->integer('discounted_amount')->nullable()->default(0);
            $table->dateTime("expired_at");
            $table->string("url")->nullable();
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
        Schema::dropIfExists('discount');
    }
}
