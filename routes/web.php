<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
})->name('/');;

route::group(['middleware' => 'auth'],function()
{
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
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
