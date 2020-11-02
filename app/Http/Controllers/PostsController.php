<?php

namespace App\Http\Controllers;

use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use App\Notifications\PostEdited;
use App\Post;
use App\Services\TagsCreatorService;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $posts = Cache::tags('posts')->remember('user_posts|' . auth()->id(), 3600, function () {
           return auth()->user()->posts()->with(['tags', 'comments'])->latest()->get();
        });

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
        pushNotification('Post created successfully', 'New Notification');

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

        $values['published'] = $request->has('published');

        $post->update($values);

        $updater = new TagsCreatorService($post, $request);
        $updater->updateTags();

//        updateTags($post, $request);

        sendMailNotifyToAdmin(new PostEdited($post));
        flash( 'Post edited successfully');
        pushNotification('Post edited successfully', 'New Notification');

        return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        sendMailNotifyToAdmin(new PostDeleted($post));
        flash( 'Post deleted successfully');
        pushNotification('Post deleted successfully', 'New Notification');

        if (auth()->user()->hasRole('admin')) {
            return redirect('/admin/posts');
        } else {
            return back();
        }
    }
}
