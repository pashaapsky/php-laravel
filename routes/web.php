<?php

use App\News;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

});

Route::get('/', function () {
    $posts = Post::with('tags')->where('published', 1)->latest()->take(3)->get();
    $news = News::with('tags')->latest()->take(3)->get();

    return view('/index', compact('posts', 'news'));
})->name('home');

Route::get('/tags/{tag}', [App\Http\Controllers\TagsController::class,'index'])->name('tags.show');

Route::resource('posts', PostsController::class);
Route::resource('news', NewsController::class)->except(['create', 'edit'])->parameters(['news' => 'new']);
Route::post('/news/{new}/comments', [App\Http\Controllers\CommentsController::class,'store'])->name('comments.store');

Route::get('/admin', [App\Http\Controllers\AdministrationController::class,'index'])->name('admin');
Route::get('/admin/posts', [App\Http\Controllers\AdministrationController::class,'posts'])->name('admin.posts');

Route::get('/admin/news', [App\Http\Controllers\AdministrationController::class,'news'])->name('admin.news');
Route::get('/admin/news/create', [App\Http\Controllers\NewsController::class,'create'])->name('news.create');
Route::get('/admin/news/{new}/edit', [App\Http\Controllers\NewsController::class,'edit'])->name('news.edit');

Route::get('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'index'])->name('feedback');;
Route::post('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'store']);

Route::get('/about', [App\Http\Controllers\StaticPagesController::class,'aboutIndex'])->name('about');
Route::get('/contacts', [App\Http\Controllers\StaticPagesController::class,'contactsIndex'])->name('contacts');

Auth::routes();
