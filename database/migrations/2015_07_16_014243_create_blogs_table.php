<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration {

	public function up()
	{
		Schema::create('blogs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('shorthand')->unique();
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('url');
			$table->string('author')->nullable();
			$table->string('author_twitter')->nullable();
			$table->string('author_email')->nullable();
			$table->string('rss_feed');
			$table->boolean('active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}
}