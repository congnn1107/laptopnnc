<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("name");
            $table->dateTime("birthday")->nullable();
            $table->integer("gender")->nullable();
            $table->string("address")->nullable();
            $table->string("email")->unique();
            $table->string("phone");
            $table->string("avatar")->nullable()->default('images/default-user.jpg');
            $table->string("password");
            $table->rememberToken();
            $table->dateTime("email_verified_at")->nullable();
            $table->integer("status")->nullable()->default(1);
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
        Schema::dropIfExists('user');
    }
}
