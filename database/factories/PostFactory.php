<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
$factory->define(Post::class, function (Faker $faker) {
	return [
		'title' => $faker->sentence(),
		'slug' => \Str::slug($faker->sentence()),
		'body' => $faker->paragraph(10),
		'user_id' => 1
	];
});
