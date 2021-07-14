<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
  public function index()
  {
    $dataTags = Tag::select('name')->orderBy('name','ASC')->get();
    $dataCategories = Category::select('id','name')->orderBy('name','ASC')->get();
    return view('admin.posts.index', compact('dataCategories', 'dataTags'));
  }

  public function store(PostRequest $request)
  {
    $post = Post::create([
      'user_id' => auth()->user()->id,
      'category_id' => $request->category,
      'title' => $request->title,
      'body' => $request->body,
      'slug' => \Str::slug($request->title)
    ]);

    $listTags = $request->tags;
    if ($post && !empty($listTags))
    {
      $tagIds = $this->addTags($listTags);
      $post->tags()->sync($tagIds);
    }

    if ($request->hasFile('thumb'))
    {
      $file = $request->file('thumb');
      $ext = $file->extension();
      $this->uploadImage($post, $file, $ext);
    }
    
    return response()->json([
      "message" => "Data has been created!",
      "type" => "create",
      "status" => 1
    ], 200);
  }

  public function addTags($listTags){
    $tagIds = [];
    foreach ($listTags as $val) {
      $tags = Tag::firstOrCreate([
        'name' => $val,
        'slug' => \Str::slug($val)
      ]);
      array_push($tagIds, $tags->id);
    }
    return $tagIds;
  }

  public function uploadImage($post, $thumb, $ext)
  {
    $oldImage = public_path().'/'.'assets/local/img/'.$post->thumb;
    if (isset($post->thumb) && $post->thumb != 'default_posts.png' && file_exists($oldImage))
    {
      unlink($oldImage);
    }

    if ($thumb->isValid())
    {
      $imageName = time().'.'.$ext;  
      $thumb->move('assets/local/img', $imageName);
      $post->thumb = $imageName;
      $post->save();
    }
  }

  public function show(Post $post)
  {
    $dataTags = Tag::select('name')->orderBy('name','ASC')->get();
    $dataCategories = Category::select('id','name')->orderBy('name','ASC')->get();
    $post = $post->with('tags:name,slug')->firstWhere('id', $post->id);
    return view('admin.posts.show', compact('post', 'dataCategories', 'dataTags')); 
  }

  public function edit(Post $post)
  {
    $post = Post::with('tags:name')->firstWhere('id', $post->id);
    return $post;
  }

  // public function getBodyImage($requestBody)
  // {
  //   $dom = new \DomDocument();
  //   $dom->loadHtml($requestBody, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
  //   $imageFile = $dom->getElementsByTagName('img');

  //   foreach($imageFile as $item => $img){
  //     $data = $img->getAttribute('src');
  //     if (isset($data) && !file_exists(public_path($data))) 
  //     {
  //       list($type, $data) = explode(';', $data);
  //       list(, $data)      = explode(',', $data);
  //       $imageDecoded      = base64_decode($data);
  //       $imageName         = "/assets/local/img/posts/".time().$item.'.png';
  //       $path              = public_path($imageName);
  //       file_put_contents($path, $imageDecoded);

  //       $img->removeAttribute('src');
  //       $img->setAttribute('src', $imageName);
  //     }
  //   }
  //   $requestBody = $dom->saveHTML();
  //   return $requestBody;
  // }

  public function update(PostRequest $request, Post $post)
  {

    // $body =  $this->getBodyImage($request->body);

    $post = Post::firstWhere('id', $post->id);
    $post->update([
      'category_id' => $request->category,
      'title' => $request->title,
      'body' => $request->title,
      'slug' => \Str::slug($request->title)
    ]);

    $listTags = $request->tags;
    if ($post && isset($listTags))
    {
      $tagIds = $this->addTags($listTags);
      $post->tags()->sync($tagIds);
    }

    if ($request->hasFile('thumb'))
    {
      $file = $request->file('thumb');
      $ext = $file->extension();
      $this->uploadImage($post, $file, $ext);
    }

    return response()->json([
      "message" => "Data has been updated!",
      "type" => "update",
      "status" => 1
    ], 200);

  }

  public function destroy(Post $post)
  {
    $body      = $post->body;
    $dom       = new \DomDocument();
    $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $imageFile = $dom->getElementsByTagName('img');

    foreach($imageFile as $item => $img){
      $data      = $img->getAttribute('src');
      $imagePath = public_path($data);
      if (file_exists($imagePath)){
        unlink($imagePath);
      }
    }

    $oldImage = public_path().'/'.'assets/local/img/'.$post->thumb;
    if ($post->thumb != 'default_posts.png' && file_exists($oldImage))
    {
      unlink($oldImage);
    }

    $post->tags()->detach($post->tags);
    $sessionID = 'blog_views'.$post->id;

    if (session()->has($sessionID))
    {
      session()->forget($sessionID);
    }

    Post::destroy($post->id);

    return response()->json([
      "message" => "Data has been deleted!",
      "type" => "delete",
      "status" => 1
    ], 200);
  }

  public function apiPosts(){
    $posts = Post::with('user:id,name')->orderBy('created_at', 'DESC')->get();
    $dt = DataTables::of($posts);
    $dt->addIndexColumn()
    ->editColumn('created_at', function ($row) {
      return $row->created_at->diffForHumans();
    })
    ->editColumn('updated_at', function ($row) {
      return $row->updated_at->diffForHumans();
    })
    ->editColumn('total_tags', function ($row) {
      return $row->tags->count();
    })
    ->addColumn('action', function($row){
      return 
      '<a href="/admin/posts/'.$row->slug.'" id ="showButton" class="btn btn-info btn-sm m-1"><i class="fa fa-search-plus"></i></a>'.
      '<button value="'.$row->id.'" id ="editButton" class="btn btn-warning btn-sm m-1"><i class="fa fa-edit"></i></button>'.
      '<button value="'.$row->id.'" id ="deleteButton" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>'
      ;
    });
    return $dt->toJson();
  }
}


// public function updateImage($post){
//   $body = $post->body;
//   $dom = new \DomDocument();
//   $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
//   $imageFile = $dom->getElementsByTagName('img');

//   foreach($imageFile as $item => $img){
//     $data      = $img->getAttribute('src');
//     $imagePath = public_path($data);
//     if (file_exists($imagePath)) 
//     {
//       unlink(public_path($imagePath));
//       $img->removeAttribute('src');
//     }
//   }
//   foreach ($imageFile as $img) {
//     $img->parentNode->removeChild($img);
//   }
//   $body = $dom->saveHTML();
//   $post = Post::firstWhere('id', $post->id)
//   ->update(["body" => $body]);
// }