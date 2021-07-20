<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		'category_id', 'title', 'body', 'slug', 'publish'
	];
	protected $hidden = ['pivot'];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function category(){
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

	public function tags(){
		return $this->belongsToMany('App\Models\Tag', 'post_tag');
	}

	public function scopeActive($query, $value)
	{
		return $query->where('publish', $value);
	}

	public function getImageAttribute(){
		return 'assets/dashboard/local/img/'.$this->thumb;
	}

	public function getMostViewedAttribute(){
		return $this->with('user:id,name','category:id,name,slug')
		->orderBy('views', 'desc')->where('publish', true)->take(5)->get();
	}

	public function relatedPosts($post){
		return $post->where([
			['category_id', $post->category_id],
			['id', '!=', $post->id]
		])->active(true)->simplePaginate(2);
	}
}
