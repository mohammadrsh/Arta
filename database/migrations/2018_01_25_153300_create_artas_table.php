<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('img');
            $table->integer('dotime');
            $table->enum('difficulty', ['veryEasy' , 'easy', 'normal', 'hard', 'veryHard']);
            $table->text('desc');
            $table->text('tags');
            $table->integer('steps');
            $table->integer('price');
            $table->integer('like');
            $table->integer('view');
            $table->integer('comments');
            $table->enum('status', ['show' , 'block', 'deleted']);
            $table->enum('type', ['post' , 'news', 'advertise', 'funpost']);
            $table->timestamps();
        });

        Schema::table('artas', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('catagory_id')->unsigned();
            $table->foreign('catagory_id')->references('id')->on('catagories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artas');
    }
}
