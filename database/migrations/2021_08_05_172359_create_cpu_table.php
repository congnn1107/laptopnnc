<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("series");
            $table->string("name")->unique();
            $table->string("gen")->nullable();
            $table->integer("cores")->nullable();
            $table->integer("threads")->nullable();
            $table->string("base_clock")->nullable();
            $table->string("turbo_clock")->nullable();
            $table->string('intergrated_gpu')->nullable();
            $table->string("cache")->nullable();
            $table->dateTime("release_date")->nullable()->useCurrent();
            $table->string("brand");
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
        Schema::dropIfExists('cpu');
    }
}
