<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/tags/{tag}', 'TagsController@index')->name('tags.show');
Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts', 'PostsController@userPosts')->name('user.posts');
Route::resource('posts', PostsController::class)->except(['index']);

Route::get('/about', 'StaticPagesController@aboutIndex')->name('about');

Route::get('/contacts', 'StaticPagesController@contactsIndex')->name('contacts');

Route::get('/admin', 'AdministrationController@index')->name('admin');
Route::get('/admin/posts', 'AdministrationController@posts')->name('admin.posts.index');

Route::get('/admin/feedbacks', 'FeedbacksController@index')->name('feedback');;
Route::post('/admin/feedbacks', 'FeedbacksController@store');

Auth::routes();
