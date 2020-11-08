<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('store');
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->get();

        return View('/admin/feedback', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'text' => 'required',
        ]);

        Feedback::create($request->all());

        flash('Feedback successfully send (:', 'success');

        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return redirect('/admin/feedbacks');
        } else {
            return back();
        }
    }
}
