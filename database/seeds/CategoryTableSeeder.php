<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category as Category;

class CategoryTableSeeder extends Seeder {

	public function run()
	{

		//create admin category
		$category = category::create([
			'name' => 'art',
			'slug' => \Str::slug('art'),
			'description' => 'Art Project'
		]);

		//Create non admin category
		$category2 = category::create([
			'name' => 'business',
			'slug' => \Str::slug('business'),
			'description' => 'Business Venture'
		]);

		//Create non admin category
		$category3 = category::create([
			'name' => 'work',
			'slug' => \Str::slug('work'),
			'description' => 'Work on the Job'
		]);


	}

}
