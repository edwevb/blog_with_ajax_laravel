<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
$factory->define(Post::class, function (Faker $faker) {
	$title = $faker->sentence();
	return [
		'user_id' => 1,
		'title' => $title,
		'slug' => \Str::slug($title),
		'body' => $faker->paragraph(10)
	];
});
