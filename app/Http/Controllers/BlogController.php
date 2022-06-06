<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function detail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('blog', compact('blog'));
    }
}
