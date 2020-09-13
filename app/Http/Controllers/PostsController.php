<?php

namespace App\Http\Controllers;

use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use App\Notifications\PostEdited;
use App\Post;
use App\Post_tag;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,post')->except(['index', 'userPosts', 'adminIndex', 'create', 'store']);
    }

    public function index()
    {
        $posts = Post::with('tags')->latest()->get();
        return view('/index', compact('posts'));
    }

    public function userPosts()
    {
        $posts = auth()->user()->posts()->with('tags')->latest()->get();
        return view('/posts.index', compact('posts'));
    }

    public function adminIndex() {
        $posts = Post::with('tags')->latest()->get();
        return view('/posts.admin-index', compact('posts'));
    }

    public function create()
    {
        return view('/posts.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'code' => 'required|unique:posts|regex:/[a-zA-Z0-9_-]+/',
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required'
        ]);

        if ($request->has('published')) {
            $attr['published'] = 1;
        }

        $attr['owner_id'] = auth()->id();

        $post = Post::create($attr);

        sendMailNotifyToAdmin(new PostCreated($post));
        flash( 'Post created successfully');

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

        sendMailNotifyToAdmin(new PostEdited($post));
        flash( 'Post edited successfully');

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        sendMailNotifyToAdmin(new PostDeleted($post));
        flash( 'Post delete successfully');

        return redirect('/posts');
    }
}
