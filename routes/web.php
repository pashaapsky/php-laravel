<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = DB::table('posts')->get();
    return view('index', compact('posts'));
})->name('home');

//Route::get('/post/', 'PostController@store');
Route::get('/post/{id}', 'PostController@index')->name('post-view');
Route::get('/post/{id}/edit', 'PostController@update');

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
