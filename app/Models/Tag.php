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

	public function getMostViewedByTagAttribute()
	{
		$tagPopular = Tag::posts()->orderBy('views','desc')->first();
		return $tagPopular;	
	}
}
