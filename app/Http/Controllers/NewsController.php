<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function validateRequest($request, $new)
    {
        return $request->validate([
            'name' => ['required', 'max:100', Rule::unique('news')->ignore($new->id)],
            'text' => 'required'
        ]);
    }

    public function index()
    {
        $news = News::all();
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
        flash('New created successfully');

        return back();
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $values = $this->validateRequest($request, $news);

        $news->update($values);
        flash( 'New updated successfully');

        return back();
    }

    public function destroy(News $news)
    {
        $news->delete();

        flash( 'New deleted successfully');

        return back(0);
    }
}
