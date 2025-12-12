<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = \App\Models\Course::with('instructor')
            ->where('is_published', true)
            ->latest()
            ->paginate(12);
            
        return view('public.courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = \App\Models\Course::with(['instructor', 'lessons', 'categories'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        return view('public.courses.show', compact('course'));
    }
}
