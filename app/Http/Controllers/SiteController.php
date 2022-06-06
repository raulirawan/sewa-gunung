<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function detail($slug)
    {
        $site = Site::where('slug', $slug)->firstOrFail();

        return view('rute', compact('site'));
    }
}
