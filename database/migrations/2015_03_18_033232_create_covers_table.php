<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('covers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type')->default('image'); // image, zoom, video, iframe
			$table->string('src');
			$table->boolean('container')->default(0);
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
		Schema::drop('covers');
	}

}
