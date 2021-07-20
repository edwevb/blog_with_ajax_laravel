<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'name', 'slug'
	];

	public function posts(){
		return $this->hasMany('App\Models\Post');
	}

	public function getTotalPostsAttribute(){
		return $this->posts()->active(true)->count();
	}

	public function getPostsAttribute(){
		return $this->posts()->active(true)->simplePaginate(2);
	}
}
