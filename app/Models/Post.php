<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		'user_id', 'category_id', 'title', 'body', 'slug', 'thumb'
	];
	protected $hidden = ['pivot'];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function category(){
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

	public function tags(){
		return $this->belongsToMany('App\Models\Tag', 'post_tag');
	}

	public function getLastPostAttribute(){
		$post = Post::with('user:id,name','category:id,name,slug')
		->orderBy('updated_at', 'desc')->take(2)->get();
		return $post;
	}

	public function getMostViewedAttribute(){
		$post = Post::with('user:id,name','category:id,name,slug')
		->orderBy('views', 'desc')->take(5)->get();
		return $post;
	}

	public function getRelatedPosts($post){
		$posts = Post::where([
			['category_id', $post->category_id],
			['id', '!=', $post->id]
		])->paginate(2);
		return $posts;
	}
}
