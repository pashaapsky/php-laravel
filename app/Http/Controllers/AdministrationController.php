<?php

namespace App\Http\Controllers;

use App\News;
use App\Post;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index() {
        return view('admin.index');
    }

    public function posts() {
        $posts = Post::with('tags')->latest()->get();
        return view('/admin.posts', compact('posts'));
    }

    public function news() {
        $news = News::all();
        return view('/news.index', compact('news'));
    }
}
