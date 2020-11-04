<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = Cache::tags(['posts', 'posts_by_tag'])->remember('posts_by_tag', 3600, function () use ($tag) {
           return $tag->posts()->with('tags')->get();
        });

        $news = Cache::tags(['news', 'news_by_tag'])->remember('news_by_tag', 3600, function () use ($tag) {
            return $tag->news()->with('tags')->get();
        });

        return view('layouts.tags.index', compact('posts', 'news'));
    }
}
