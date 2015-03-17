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
			$table->integer('position');
			$table->string('heading')->nullable();
			$table->string('body')->nullable();
			$table->string('image')->nullable();
			$table->string('caption')->nullable();
			$table->string('layout')->default('row');
			$table->string('width')->default('1-1');
			$table->string('height')->default('height-30');
			$table->string('font_color')->default('#000');
			$table->string('background_color')->default('#FFF');
			$table->string('animation')->default('slide-bottom');
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
