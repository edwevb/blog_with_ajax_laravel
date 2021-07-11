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

	public function getListCategoryAttribute(){
		$category = $this->with('posts')->get();
		return $category;
	}
}
