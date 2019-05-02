<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin','user'])->default('user');
            $table->string('email')->unique()->nullable();
            $table->string('f_name', 50);
            $table->string('l_name', 50);
            $table->string('avatar', 100)->nullable();
            $table->string('phone', 20);
            $table->string('address', 200)->nullable();
            $table->enum('gender', ['male','female'])->default('male');
            $table->string('national_code', 10)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
