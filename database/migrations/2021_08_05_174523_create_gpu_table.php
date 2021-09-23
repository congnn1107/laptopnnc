<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpu', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("series");
            $table->string("name");
            $table->string("graph_memory_cap");
            $table->string("clock");
            $table->dateTime("release_date")->nullable();
            $table->string("brand");
            $table->string("addition");
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
        Schema::dropIfExists('gpu');
    }
}
