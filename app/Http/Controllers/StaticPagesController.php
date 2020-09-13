<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function contactsIndex() {
        return view('static.contacts');
    }

    public function aboutIndex() {
        return view('static.about');
    }
}
