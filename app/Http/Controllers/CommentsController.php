<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getValuesForStore($request, $model, $modelClassName) {
        $values = $request->validate([
            'text' => 'required'
        ]);

        $values['commentable_id'] = $model;
        $values['commentable_type'] = $modelClassName;

        return $values;
    }

    public function newsCommentStore(Request $request, $new)
    {
        $values = $this->getValuesForStore($request, $new, News::class);

        $comment = Comment::create($values);
        flash('Comment create successfully');

        return back();
    }

    public function postsCommentStore(Request $request, $post)
    {
        $values = $this->getValuesForStore($request, $post, Post::class);

        $comment = Comment::create($values);

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
