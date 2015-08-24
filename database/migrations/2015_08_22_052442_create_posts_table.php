<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->nullable();
			$table->string('url');
			$table->text('excerpt')->nullable();
			$table->integer('blog_id')->unsigned();
			$table->timestamp('publishing_date');
			$table->text('content')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}