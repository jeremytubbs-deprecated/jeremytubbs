<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User as User;
use App\Group as Group;

class UserTableSeeder extends Seeder {

	public function run()
	{
		///create admin role
		$group = Group::create([
			'name' => 'admin'
		]);

		//create admin user
		$user = User::create([
			'name' => 'admin',
			'password' => Hash::make('password'),
			'email'	   => 'admin@admin.com'
		]);

		//Create non admin user
		$user2 = User::create([
			'name' => 'user',
			'password' => Hash::make('password'),
			'email'	   => 'user@user.com'
		]);

		//assign admin role to first user
		$user->assignGroup(1);

	}

}
