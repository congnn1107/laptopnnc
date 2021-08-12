<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("name");
            $table->string("username");
            $table->string("password");
            $table->unsignedBigInteger("role")->default(1)->nullable();
            $table->integer("status")->default(1)->nullable();
            $table->timestamps();

            //foreign key
            // $table->foreign("role")->references("id")->on("role");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
