<?php

use App\News;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Cache::tags(['posts', 'latest_publish_posts'])->remember('latest_publish_posts', 3600, function () {
        return Post::with('tags')->where('published', 1)->latest()->take(4)->get();
    });

    $news = Cache::tags(['news', 'latest_news'])->remember('latest_news', 3600, function () {
        return News::with('tags')->latest()->take(3)->get();
    });

    return view('/index', compact('posts', 'news'));
})->name('home');

Route::get('/tags/{tag}', [App\Http\Controllers\TagsController::class,'index'])->name('tags.show');

Route::resource('posts', PostsController::class);
Route::resource('news', NewsController::class)->except(['create', 'edit'])->parameters(['news' => 'new']);
Route::post('/news/{new}/comments/', [App\Http\Controllers\CommentsController::class,'newsCommentStore'])->name('comments.news.store');
Route::post('/post/{post}/comments/', [App\Http\Controllers\CommentsController::class,'postsCommentStore'])->name('comments.posts.store');
Route::delete('/comments/{comment}', [App\Http\Controllers\CommentsController::class,'destroy'])->name('comments.destroy');

Route::get('/admin', [App\Http\Controllers\AdministrationController::class,'index'])->name('admin');
Route::get('/admin/posts', [App\Http\Controllers\AdministrationController::class,'posts'])->name('admin.posts');

Route::get('/admin/news', [App\Http\Controllers\AdministrationController::class,'news'])->name('admin.news');
Route::get('/admin/news/create', [App\Http\Controllers\NewsController::class,'create'])->name('news.create');
Route::get('/admin/news/{new}/edit', [App\Http\Controllers\NewsController::class,'edit'])->name('news.edit');
Route::get('/admin/orders', [App\Http\Controllers\AdministrationController::class,'orders'])->name('admin.orders');
Route::post('/admin/orders', [App\Http\Controllers\AdministrationController::class,'ordersStore'])->name('admin.orders.store');

Route::get('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'index'])->name('feedback');;
Route::post('/admin/feedbacks', [App\Http\Controllers\FeedbacksController::class,'store']);

Route::get('/about', [App\Http\Controllers\StaticPagesController::class,'aboutIndex'])->name('about');
Route::get('/contacts', [App\Http\Controllers\StaticPagesController::class,'contactsIndex'])->name('contacts');
Route::get('/statistics', [App\Http\Controllers\StaticPagesController::class,'statisticsIndex'])->name('statistics');

Auth::routes();
