<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function newsCommentStore(Request $request, News $new)
    {
        $values = $request->validate([
            'text' => 'required'
        ]);

        $new->comments()->create($values);

        flash('Comment create successfully');

        return back();
    }

    public function postsCommentStore(Request $request, Post $post)
    {
        $values = $request->validate([
            'text' => 'required'
        ]);

        $post->comments()->create($values);

        flash('Comment create successfully');

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        flash('Comment delete successfully');

        return back();
    }
}
