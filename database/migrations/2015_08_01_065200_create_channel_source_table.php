<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_source', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('channel_id')->unsigned();
            $table->integer('source_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('channel_source');
    }
}
