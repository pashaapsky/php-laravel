<?php

use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::latest()->get();
    $tags = Tag::all();
    return view('/index', compact('posts', 'tags'));
})->name('home');


Route::get('/admin/posts', 'PostsController@index')->name('post-index');
Route::get('/posts/create', 'PostsController@create')->name('post-create');
Route::get('/posts/{post}', 'PostsController@show')->name('post-show');
Route::post('/posts/', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');


Route::get('/about', function () {
    return view('static.about');
})->name('about');

Route::get('/contacts', function () {
    return view('static.contacts');
})->name('contacts');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

Route::get('/admin/feedbacks', 'FeedbacksController@index')->name('feedback');;
Route::post('/admin/feedbacks', 'FeedbacksController@store');

Auth::routes();
