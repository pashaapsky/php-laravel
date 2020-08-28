<?php

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::latest()->get();

    return view('/index', compact('posts'));
})->name('home');


Route::get('/posts/create', 'PostsController@create')->name('post-create');
Route::post('/posts/', 'PostsController@store');
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

Route::get('/admin/feedbacks', 'FeedbacksController@index')->name('feedback');;
Route::post('/admin/feedbacks', 'FeedbacksController@store');

Auth::routes();
