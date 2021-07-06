<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	* Seed the application's database.
	*
	* @return void
	*/
	public function run()
	{
		factory(App\Models\Post::class, 5)->create();
		factory(App\Models\Tag::class, 5)->create();
		factory(App\Models\Category::class, 5)->create();
    $this->call(UserSeeder::class);
	}
}
