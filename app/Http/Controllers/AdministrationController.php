<?php

namespace App\Http\Controllers;

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
        return view('/posts.admin-index', compact('posts'));
    }
}
