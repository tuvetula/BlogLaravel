<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Posts extends Controller
{
    public function index()
    {
        return view('Pages/posts');
    }
}
