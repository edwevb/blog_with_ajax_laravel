<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
    $data = $request->all();
    $data['slug'] = \Str::slug($request->title);
    $data['category_id'] = $request->category;

    $post = auth()->user()->posts()->create($data);

    if ($post && !empty($data['tags']))
    {
      $tagIds = $this->addTags($data['tags']);
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
    if (!empty($listTags)) {
      foreach ($listTags as $val) {
        $tags = Tag::firstOrCreate([
          'name' => $val,
          'slug' => \Str::slug($val)
        ]);
        array_push($tagIds, $tags->id);
      }
    }
    return $tagIds;
  }

  public function uploadImage($post, $thumb, $ext)
  {
    $oldImage = public_path().'/'.'assets/dashboard/local/img/'.$post->thumb;
    if (isset($post->thumb) && $post->thumb != 'default_posts.png' && file_exists($oldImage))
    {
      unlink($oldImage);
    }

    if ($thumb->isValid())
    {
      $imageName = $post->slug.time().'.'.$ext;  
      $thumb->move('assets/dashboard/local/img/', $imageName);
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

  public function update(PostRequest $request, Post $post)
  {
    $data = $request->all();
    $data['slug'] = \Str::slug($request->title);
    $data['category_id'] = $request->category;
    $post->update($data);

    if ($post && !empty($data['tags']))
    {
      $tagIds = $this->addTags($data['tags']);
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
    if ($post->thumb != 'default_posts.png' && file_exists($post->image))
    {
      unlink($post->image);
    }
    $post->tags()->detach();

    $sessionID = 'blog_views'.$post->id;
    if (session()->has($sessionID))
    {
      session()->forget($sessionID);
    }

    $post->delete();

    return response()->json([
      "message" => "Data has been deleted!",
      "type" => "delete",
      "status" => 1
    ], 200);
  }

  public function publish(Request $request, Post $post){
    $status = $request->publish == 1 ? 0 : 1;
    $post->update(['publish' => $status]);

    return response()->json([
      "message" => "The post has been updated!",
      "status" => 1
    ], 200);
  }

  public function apiPosts(){
    $query = Post::getData();
    $dt = DataTables::of($query);

    $dt->addIndexColumn()
    ->editColumn('created_at', function ($row) {
      return $row->created_at->format('d F, Y h:i:sa');
    })
    ->editColumn('publish', function ($row) {
      if ($row->publish) {
        $btn = '<span data-active="'.$row->publish.'" value="'.$row->id.'" id="activePosts" class="badge badge-success">Active</span>';
      }else{
        $btn = '<span data-active="'.$row->publish.'" value="'.$row->id.'" id="activePosts" class="badge badge-danger">Inactive</span>';
      }
      return $btn;
    })
    ->addColumn('action', function($row){
      return 
      '<div class="d-flex justify-content-around">
      <a href="/admin/posts/'.$row->slug.'" id ="showButton" class="btn btn-info btn-sm"><i class="fa fa-search-plus"></i></a>'.
      '<button value="'.$row->id.'" id="editButton" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>'.
      '<button value="'.$row->id.'" id="deleteButton" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></div>'
      ;
    })
    ->removeColumn('slug')
    ->rawColumns(['publish','action','test']);
    return $dt->toJson();
  }
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