<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepmediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stepmedia', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['image', 'video', 'audio']);
            $table->string('link');
            $table->string('title');
            $table->integer('priority');
            $table->timestamps();
        });

        Schema::table('stepmedia', function (Blueprint $table) {
            $table->integer('arta_id')->unsigned();
            $table->foreign('arta_id')->references('id')->on('artas');

            $table->integer('step_id')->unsigned();
            $table->foreign('step_id')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stepmedia');
    }
}
