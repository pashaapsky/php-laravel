<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, News $new)
    {
        $values = $request->validate([
           'text' => 'required'
        ]);

        $values['commentable_id'] = $new->id;
        $values['commentable_type'] = News::class;

        $comment = Comment::create($values);

        return back();
    }
}
