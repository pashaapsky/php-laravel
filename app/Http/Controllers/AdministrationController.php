<?php

namespace App\Http\Controllers;

use App\News;
use App\Post;
use Illuminate\Http\Request;

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
        $news = News::latest()->get();
        return view('/admin.news', compact('news'));
    }

    public function orders() {
        return view('/admin.orders');
    }

    public function ordersStore(Request $request) {

        \App\Jobs\GenerateResultingOrder::dispatch($request->all());

        return back();
    }
}
