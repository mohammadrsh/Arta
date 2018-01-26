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
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email', 191)->unique();
            $table->string('username', 191)->nullable();
            $table->string('password', 191);
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('reg_id', 191)->unique()->nullable();
            $table->string('secure_id', 191)->unique()->nullable();
            $table->boolean('is_peremium');
            $table->bigInteger('imei');
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
