<?php

namespace App\Http\Controllers;

use App\News;
use App\Services\TagsCreatorService;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $news = Cache::tags('news')->remember('users_news|' . auth()->id(), 3600, function () {
           return News::with(['tags', 'comments'])->latest()->get();
        });

//        $news = News::with(['tags', 'comments'])->latest()->get();

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

        $updater = new TagsCreatorService($new, $request);
        $updater->updateTags();

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
