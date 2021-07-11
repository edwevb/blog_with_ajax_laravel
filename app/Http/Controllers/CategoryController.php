<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index()
	{
		return view('admin.categories.index');
	}

	public function store(CategoryRequest $request){
		$category = Category::create([
			'name' => $request->name,
			'slug' => \Str::slug($request->name)
		]);

		return response()->json([
			"message" => "Data has been created!",
			"status" => 1
		], 200);
	}

	public function show(Category $category){
		$dataPosts = Post::select('id','title')->where('category_id', null)
		->orderBy('title','ASC')->get();
		return view('admin.categories.show', compact('category','dataPosts')); 
	}


	public function edit(Category $category){
		return $category;
	}

	public function update(CategoryRequest $request, Category $category){
		$category = Category::firstWhere('id', $category->id);
		$category->update([
			'name' => $request->name,
			'slug' => \Str::slug($request->name)
		]);

		return response()->json([
			"message" => "Data has been updated!",
			"status" => 1
		], 200);
	}

	public function destroy(Category $category){
		$posts = Post::where('category_id', $category->id)->get();

		if ($posts->isNotEmpty()) {
			foreach ($posts as $post) {
				$post->update([
					'category_id' => null
				]);
			}
		}

		Category::destroy($category->id);
		return response()->json([
			"message" => "Data has been deleted!",
			"status" => 1
		], 200);
	}

	public function apiCategories(){
		$categories = Category::orderBy('created_at', 'DESC')->get();
		$dt = DataTables::of($categories);
		$dt->addIndexColumn()
		->editColumn('created_at', function ($row) {
			return $row->created_at->diffForHumans();
		})
		->editColumn('total_posts', function ($row) {
			return $row->posts->count();
		})
		->addColumn('action', function($row){
			return 
			'<a href="/admin/categories/'.$row->slug.'" id ="showButton" class="btn btn-info btn-sm m-1"><i class="fa fa-search-plus"></i></a>'.
			'<button value="'.$row->id.'" id ="editButton" class="btn btn-warning btn-sm m-1"><i class="fa fa-edit"></i></button>'.
			'<button value="'.$row->id.'" id ="deleteButton" class="btn btn-danger btn-sm m-1"><i class="fa fa-trash"></i></button>'
			;
		});
		return $dt->toJson();
	}

	public function addPost(Request $request, Category $category){
		$reqPosts = $request->posts;
		if (isset($reqPosts)){
			$post = Post::firstWhere('id', $reqPosts)
			->update([
				'category_id' => $category->id
			]);
		}
		return response()->json([
			"message" => "Posts added successfully!",
			"status" => 1
		], 200);
	}

	public function removePost(Request $request){
		$post = Post::firstWhere('id', $reqPosts)
		->update([
			'category_id' => null
		]);

		return response()->json([
			"message" => "Posts removed successfully!",
			"status" => 1
		], 200);
	}

} //END OF CLASS
