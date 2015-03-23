<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_assets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->string('src')->nullable();
			$table->string('heading')->nullable();
			$table->string('body')->nullable();
			$table->string('caption')->nullable();
			$table->string('layout')->default('row'); // row, 2-1, 1-2
			$table->string('container')->default('center');
			$table->string('gutter')->nullable(); // medium, small, collapse
			$table->string('width')->default('1-1');
			$table->string('height')->default('height-30');
			$table->string('font_color')->default('#000');
			$table->string('background_color')->default('#FFF');
			$table->string('text_animation')->default('fade');
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
		Schema::drop('project_assets');
	}

}
