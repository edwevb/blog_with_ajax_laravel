<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
	public function index()
	{
		return view('admin.tags.index');
	}

	public function store(TagRequest $request)
	{
		$tag = Tag::create([
			'name' => $request->name,
			'slug' => \Str::slug($request->name),
		]);

		return response()->json([
			"message" => "Data has been created!",
			"status" => 1
		], 200);
	}

	public function show(Tag $tag){
		$dataPosts = Post::select('id','title')->orderBy('title','ASC')->get();
		return view('admin.tags.show', compact('tag','dataPosts')); 
	}

	public function edit(Tag $tag){
		return $tag;
	}

	public function update(TagRequest $request, Tag $tag){
		$tag = Tag::firstWhere('id', $tag->id);
		$tag->update([
			'name' => $request->name,
			'slug' => \Str::slug($request->name)
		]);

		return response()->json([
			"message" => "Data has been updated!",
			"status" => 1
		], 200);
	}

	public function destroy(Tag $tag){
		$tag->posts()->detach($tag->posts);
		Tag::destroy($tag->id);
		return response()->json([
			"message" => "Data has been deleted!",
			"status" => 1
		], 200);
	}

	public function apiTags(){
		$tags = Tag::orderBy('created_at', 'DESC')->get();
		$dt = DataTables::of($tags);
		$dt->addIndexColumn()
		->editColumn('created_at', function ($row) {
			return $row->created_at->diffForHumans();
		})
		->editColumn('total_posts', function ($row) {
			return $row->posts->count();
		})
		->addColumn('action', function($row){
			return 
			'<a href="/admin/tags/'.$row->slug.'" id ="showButton" class="btn btn-info btn-sm m-1"><i class="fa fa-search-plus"></i></a>'.
			'<button value="'.$row->id.'" id ="editButton" class="btn btn-warning btn-sm m-1"><i class="fa fa-edit"></i></button>'.
			'<button value="'.$row->id.'" id ="deleteButton" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>'
			;
		});
		return $dt->toJson();
	}

	public function addPost(Request $request, Tag $tag){
		$reqPost = $request->posts;
		if (isset($reqPost)){
			$tag->posts()->attach($reqPost);
		}
		
		return response()->json([
			"message" => "Posts added successfully!",
			"status" => 1
		], 200);
	}

	public function removePost(Request $request, Tag $tag){
		$reqPost = $request->posts;
		if (isset($reqPost)){
			$tag->posts()->detach($reqPost);
		}
		return response()->json([
			"message" => "Posts removed successfully!",
			"status" => 1
		], 200);
	}
}
