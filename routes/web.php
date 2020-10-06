<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

});

Route::get('/tags/{tag}', [App\Http\Controllers\TagsController::class,'index'])->name('tags.show');
Route::get('/', [App\Http\Controllers\PostsController::class,'index'])->name('home');
Route::get('/posts', [App\Http\Controllers\PostsController::class,'userPosts'])->name('user.posts');

Route::resource('posts', PostsController::class)->except(['index']);
Route::resource('news', NewsController::class)->except(['create', 'edit'])->parameters(['news' => 'new']);

Route::get('/admin/news/create', [App\Http\Controllers\NewsController::class,'create'])->name('news.create');
Route::get('/admin/news/{new}/edit', [App\Http\Controllers\NewsController::class,'edit'])->name('news.edit');

Route::get('/admin', [App\Http\Controllers\AdministrationController::class,'index'])->name('admin');
Route::get('/admin/posts', [App\Http\Controllers\AdministrationController::class,'posts'])->name('admin.posts');
Route::get('/admin/news', [App\Http\Controllers\AdministrationController::class,'news'])->name('admin.news');

Route::get('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'index'])->name('feedback');;
Route::post('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'store']);

Route::get('/about', [App\Http\Controllers\StaticPagesController::class,'aboutIndex'])->name('about');
Route::get('/contacts', [App\Http\Controllers\StaticPagesController::class,'contactsIndex'])->name('contacts');

Auth::routes();
