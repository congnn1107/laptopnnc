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
            $table->string("series")->unique();
            $table->string("name");
            $table->string("gen");
            $table->integer("cores");
            $table->integer("threads");
            $table->string("base_clock");
            $table->string("turbo_clock");
            $table->string('intergrated_vga');
            $table->string("cache");
            $table->dateTime("release_date")->nullable();
            $table->string("branch");
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
