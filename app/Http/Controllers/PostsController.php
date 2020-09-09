<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_tag;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->latest()->get();
        return view('/index', compact('posts'));
    }

    public function adminIndex() {
        $posts = Post::with('tags')->latest()->get();
        return view('/posts.index', compact('posts'));
    }

    public function create()
    {
        return view('/posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:posts|regex:/[a-zA-Z0-9_-]+/',
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required'
        ]);

        if ($request->all(['published'])) {
            $request->merge(['published' => 1]);
        }

        Post::create($request->all());

        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('/posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('/posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $values = $request->validate([
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required'
        ]);

        $post->update($values);

        $postTags = $post->tags->keyBy('name');

        if (!is_null($request['tags'])) {
            $requestTags = collect(explode(', ', $request['tags']))->keyBy(function ($item) { return $item; });
        } else {
            $requestTags = collect([]);
        }

        $deleteTags = $postTags->diffKeys($requestTags);
        $addTags = $requestTags->diffKeys($postTags);

        if ($addTags->isNotEmpty()) {
            foreach ($addTags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tag);
            };
        }

        if ($deleteTags->isNotEmpty()) {
            foreach ($deleteTags as $tag) {
                $post->tags()->detach($tag);
                $isLastTag = Post_tag::where('tag_id', $tag->id)->first();
                if (!$isLastTag) $tag->delete();
            };
        }

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/admin/posts');
    }
}
