<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified CMS page.
     */
    public function show($slug)
    {
        $page = \App\Models\Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('public.pages.show', compact('page'));
    }
}
