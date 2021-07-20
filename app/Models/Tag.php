<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
		'name', 'slug'
	];
	protected $hidden = ['pivot'];

	public function posts(){
		return $this->belongsToMany('App\Models\Post', 'post_tag');
	}

	public function getTotalPostsAttribute(){
		return $this->posts()->active(true)->count();
	}

	public function getPostsAttribute(){
		return $this->posts()->active(true)->simplePaginate(2);
	}
}
