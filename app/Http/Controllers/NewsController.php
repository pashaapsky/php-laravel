<?php

namespace App\Http\Controllers;

use App\News;
use App\NewTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    public function validateRequest($request, $new)
    {
        return $request->validate([
            'name' => ['required', 'max:100', Rule::unique('news')->ignore($new->id)],
            'text' => 'required'
        ]);
    }

    public function index()
    {
        $news = News::with(['tags', 'comments'])->latest()->get();

        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $values = $this->validateRequest($request, new News());

        $new = News::create($values);

        if (!is_null($request['tags'])) {
            $requestTags = explode(', ', $request['tags']);
            foreach ($requestTags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $new->tags()->attach($tag);
            }
        }

        flash('New created successfully');

        return back();
    }

    public function show(News $new)
    {
        return view('news.show', compact('new'));
    }

    public function edit(News $new)
    {
        return view('news.edit', compact('new'));
    }

    public function update(Request $request, News $new)
    {
        $values = $this->validateRequest($request, $new);

        $new->update($values);

        $newTags = $new->tags->keyBy('name');

        updateTags($new, $request, NewTag::class);

        flash( 'New updated successfully');

        return back();
    }

    public function destroy(News $new)
    {
        $new->delete();

        flash( 'New deleted successfully');

        return redirect('/admin/news');
    }
}
