<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post, Category, Tag};
class PagesController extends Controller
{
  public function index()
  {
    $posts = Post::with('user','category', 'tags')->latest()->simplePaginate(4);
    return view('home',compact('posts'));
  }

  public function showPost(Post $post)
  {
    $sessionID = 'blog_views'.$post->id;
    if (!session()->has($sessionID)) {
      Post::where('id', $post->id)->increment('views');
      session()->put($sessionID, 1);
    }
    $post = Post::with('user','category')->firstWhere('id', $post->id);
    return view('blog.detail_post', compact('post'));
  }

  public function showCategory(Category $category){
    $posts = $category->posts()->where('category_id', $category->id)->simplePaginate(2);
    return view('blog.detail_category', compact('category', 'posts'));
  }

  public function showTags(Tag $tag){
    $posts = $tag->posts()->simplePaginate(2);
    return view('blog.detail_tags', compact('tag', 'posts'));
  }

  public function listCategories(){
    $categories = Category::get();
    return view('blog.list_category', compact('categories'));
  }

  public function listTags(){
    $tags = Tag::get();
    return view('blog.list_tag', compact('tags'));
  }

  public function about(){
    return view('blog.about');
  }
}
