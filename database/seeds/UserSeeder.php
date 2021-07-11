<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		\App\User::create([
			'name'	=> 'Edward',
			'roles' => 1,
			'email'	=> 'edwardevbert@gmail.com',
			'password'	=> bcrypt('edward123'),
			'created_at' => now()
		],
		[
			'name'	=> 'demo visitor',
			'email'	=> 'visitor@gmail.com',
			'password'	=> bcrypt('demo123'),
			'created_at' => now()
		]);
	}
}
