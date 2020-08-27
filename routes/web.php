<?php

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::latest()->get();
    return view('index', compact('posts'));
})->name('home');

//Route::get('/post/', 'PostController@store');
Route::get('/posts/{post}', 'PostsController@show')->name('post-show');
Route::get('/posts/{id}/edit', 'PostsController@update');

Route::get('/about', function () {
    return view('static.about');
})->name('about');

Route::get('/contacts', function () {
    return view('static.contacts');
})->name('contacts');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

Auth::routes();
