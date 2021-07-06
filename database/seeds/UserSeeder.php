<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		\App\User::create([
			'name'	=> 'Edward',
			'roles' => 'admin',
			'email'	=> 'admin@gmail.com',
			'password'	=> bcrypt('edward123'),
			'created_at' => now()
		],
		[
			'name'	=> 'visitor',
			'email'	=> 'visitor@gmail.com',
			'password'	=> bcrypt('edward123'),
			'created_at' => now()
		]);
	}
}
