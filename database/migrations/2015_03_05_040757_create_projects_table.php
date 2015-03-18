<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('cover_id')->nullable();
			$table->string('title')->unique();
			$table->string('medium')->nullable();
			$table->string('slug')->unique();
			$table->string('summary')->nullable();
			$table->string('summary_background_color')->nullable();
			$table->string('summary_font_color')->nullable();
			$table->string('link')->nullable();
			$table->string('link_text')->nullable();
			$table->mediumText('markdown')->nullable();
			$table->mediumText('html')->nullable();
			$table->boolean('featured')->default(0);
			$table->boolean('published')->default(0);
			$table->boolean('ongoing')->default(0);
			$table->timestamp('started_at')->nullable();
			$table->timestamp('finished_at')->nullable();
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
		Schema::drop('projects');
	}

}
