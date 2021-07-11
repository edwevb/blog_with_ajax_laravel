<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post, Category, Tag};
class PagesController extends Controller
{
  public function index()
  {
    $posts = Post::with('user','category', 'tags')->latest()->paginate(4);
    $categories = Category::with('posts')->orderBy('created_at')->get();
    $tags = Tag::with('posts')->orderBy('created_at')->get();
    return view('home',compact('posts', 'categories', 'tags'));
  }

  public function showPost(Post $post)
  {
    $sessionID = 'blog_views'.$post->id;
    if (!session()->has($sessionID)) {
      Post::where('id', $post->id)->increment('views');
      session()->put($sessionID, 1);
    }
    $categories = Category::with('posts')->orderBy('created_at')->get();
    $tags = Tag::with('posts')->orderBy('created_at')->get();
    $post = Post::with('user','category', 'tags')->firstWhere('id', $post->id);
    return view('blog.detail_post', compact('post', 'tags', 'categories'));
  }

  public function showCategory(Category $category){
    $posts = $category->posts()->where('category_id', $category->id)->paginate(5);
    return view('blog.detail_category', compact('category', 'posts'));
  }
}
