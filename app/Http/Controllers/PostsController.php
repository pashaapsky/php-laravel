<?php

namespace App\Http\Controllers;

use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use App\Notifications\PostEdited;
use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateRequest($request, $post)
    {
        return $request->validate([
            'code' => ['required', 'regex:/[a-zA-Z0-9_-]+/', Rule::unique('posts')->ignore($post->id)],
            'name' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required'
        ]);
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

    public function create()
    {
        return view('/posts.create');
    }

    public function store(Request $request)
    {
        $attr = $this->validateRequest($request, new Post());

        if ($request->has('published')) {
            $attr['published'] = 1;
        }

        $attr['owner_id'] = auth()->id();

        $post = Post::create($attr);

        if (!is_null($request['tags'])) {
            $requestTags = explode(', ', $request['tags']);
            foreach ($requestTags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tag);
            }
        }

        sendMailNotifyToAdmin(new PostCreated($post));
        flash( 'Post created successfully');

        return redirect('/');
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return view('/posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('/posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $values = $this->validateRequest($request, $post);

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
                $isLastTag = PostTag::where('tag_id', $tag->id)->first();
                if (!$isLastTag) $tag->delete();
            };
        }

        sendMailNotifyToAdmin(new PostEdited($post));
        flash( 'Post edited successfully');

        return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        sendMailNotifyToAdmin(new PostDeleted($post));
        flash( 'Post delete successfully');

        return redirect('/posts');
    }
}
