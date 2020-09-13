<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/tags/{tag}', 'TagsController@index');

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts', 'PostsController@userPosts')->name('user-posts');
Route::get('/posts/create', 'PostsController@create')->name('post-create');
Route::get('/posts/{post}', 'PostsController@show')->name('post-show');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::post('/posts', 'PostsController@store');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');

Route::get('/admin/posts', 'PostsController@adminIndex')->name('admin-post-index');

Route::get('/about', 'StaticPagesController@aboutIndex')->name('about');

Route::get('/contacts', 'StaticPagesController@contactsIndex')->name('contacts');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

Route::get('/admin/feedbacks', 'FeedbacksController@index')->name('feedback');;
Route::post('/admin/feedbacks', 'FeedbacksController@store');

Auth::routes();
