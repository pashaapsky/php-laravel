<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
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
        //
    }

    public function show(News $new)
    {
        return view('news.show', compact('new'));
    }

    public function edit(News $new)
    {
        return view('news.edit', compact('new'));
    }

    public function update(Request $request, News $news)
    {
        $values = $request->validate([
            'name' => 'required|unique:news|max:100',
            'text' => 'required',
        ]);

        $news->update($values);

        return back();
    }

    public function destroy(News $news)
    {
        //
    }
}
