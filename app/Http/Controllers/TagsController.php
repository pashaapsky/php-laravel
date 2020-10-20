<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->with('tags')->get();
        $news = $tag->news()->with('tags')->get();
        return view('layouts.tags.index', compact('posts', 'news'));
    }
}
