<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, Tag};
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PagesController extends Controller
{
  public function index()
  {
    $posts = Post::with('user','category','tags')->active(true)->latest()->simplePaginate(4);
    return view('home',compact('posts'));
  }

  public function searchPosts(){
    $keywords = request('keywords');
    $posts = Post::with('user','category','tags')->where('title', 'like', "%$keywords%")->active(true)->latest()->simplePaginate(4);
    
    if ($posts->isEmpty() || empty($keywords)) throw new ModelNotFoundException;
    return view('blog.search',compact('posts'));
  }

  public function showPost(Post $post)
  {
    $this->addViewSession($post->id);

    $post = Post::with('user','category')->active(true)->firstWhere('id', $post->id);
    if (!$post) throw new ModelNotFoundException;
    return view('blog.detail_post', compact('post'));
  }

  public function addViewSession($id){
    $sessionID = 'blog_views'.$id;
    if (!session()->has($sessionID)) {
      Post::where('id', $id)->increment('views');
      session()->put($sessionID, 1);
    }
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

  public function showCategory(Category $category){
    return view('blog.detail_category', compact('category'));
  }

  public function showTags(Tag $tag){
    $posts = $tag->posts()->simplePaginate(2);
    return view('blog.detail_tags', compact('tag', 'posts'));
  }
}
