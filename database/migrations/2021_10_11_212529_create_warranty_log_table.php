<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_log', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('warranty_id');
            $table->text('problem')->nullable();
            $table->text('product_condition')->nullable();
            $table->dateTime('receive_at')->nullable();
            $table->dateTime('return_at')->nullable();
            $table->double('cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warranty_log');
    }
}
