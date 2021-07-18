<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@index')->name('home');
Route::get('/posts/{post:slug}', 'PagesController@showPost')->name('posts.showPost');
Route::get('/list-categories', 'PagesController@listCategories')->name('home.listCategories');
Route::get('/categories/{category:slug}', 'PagesController@showCategory')->name('home.categories');
Route::get('/tags/{tag:slug}', 'PagesController@showTags')->name('home.tags');
Route::get('/list-tags', 'PagesController@listTags')->name('home.listTags');
Route::get('/about', 'PagesController@about')->name('home.about');

route::group(['prefix' => '/admin', 'middleware' => ['auth','CheckRole:1']],function()
{
	Route::get('/', function () {
		return view('admin.index');
	});
	
	Route::get('/dashboard', function () {
		return view('admin.index');
	});

	Route::get('api.posts', 'PostController@apiPosts')->name('api.posts');
	Route::get('/posts', 'PostController@index')->name('posts.index');
	Route::post('/posts', 'PostController@store')->name('posts.store');
	Route::get('/posts/{post:slug}', 'PostController@show')->name('posts.show');
	Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
	Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
	Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');

	Route::get('api.categories', 'CategoryController@apiCategories')->name('api.categories');
	Route::get('/categories', 'CategoryController@index')->name('categories.index');
	Route::get('/categories/{category:slug}', 'CategoryController@show')->name('categories.show');
	Route::post('/categories', 'CategoryController@store')->name('categories.store');
	Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
	Route::put('/categories/{category}', 'CategoryController@update')->name('categories.update');
	Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');
	Route::put('/categories/add-post/{category}', 'CategoryController@addPost')->name('categories.addPost');
	Route::put('/categories/remove-post/{category}', 'CategoryController@removePost')->name('categories.removePost');

	Route::get('api.tags', 'TagController@apiTags')->name('api.tags');
	Route::get('/tags', 'TagController@index')->name('tags.index');
	Route::get('/tags/{tag:slug}', 'TagController@show')->name('tags.show');
	Route::post('/tags', 'TagController@store')->name('tags.store');
	Route::get('/tags/{tag}/edit', 'TagController@edit')->name('tags.edit');
	Route::put('/tags/{tag}', 'TagController@update')->name('tags.update');
	Route::delete('/tags/{tag}', 'TagController@destroy')->name('tags.destroy');
	Route::put('/tags/add-post/{tag}', 'TagController@addPost')->name('tags.addPost');
	Route::put('/tags/remove-post/{tag}', 'TagController@removePost')->name('tags.removePost');

	Route::get('/change-password', 'ChangePasswordController@index')->name('changePassword.index');;
	Route::post('/change-password', 'ChangePasswordController@store')->name('changePassword.store');

	Route::get('/preview', function(){
		return view('components.preview');
	});
});


Auth::routes(['register'=>false]);
