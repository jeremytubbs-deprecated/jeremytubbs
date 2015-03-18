<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('project_id')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('cover_id')->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('summary')->nullable();
			$table->mediumText('markdown')->nullable();
			$table->mediumText('html')->nullable();
			$table->boolean('featured')->default(0);
			$table->boolean('published')->default(0);
			$table->timestamp('published_at')->nullable();
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
		Schema::drop('posts');
	}

}
