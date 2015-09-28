<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('facebook')->nullable()->unsigned();
            $table->integer('twitter')->nullable()->unsigned();
            $table->integer('total')->nullable()->unsigned();
            $table->integer('virality')->nullable()->unsigned();
            $table->integer('post_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('scores');
    }
}