<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_post', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('channel_id')->unsigned();
            $table->integer('post_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('channel_post');
    }
}
