<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = \App\Models\Course::where('is_published', true)
            ->where('is_featured', true)
            ->with(['instructor', 'categories'])
            ->take(3)
            ->get();

        if ($featuredCourses->isEmpty()) {
            $featuredCourses = \App\Models\Course::where('is_published', true)
                ->with(['instructor', 'categories'])
                ->latest()
                ->take(3)
                ->get();
        }

        $totalCourses = \App\Models\Course::where('is_published', true)->count();
        $totalStudents = \App\Models\User::where('role', 'student')->count();
        $totalInstructors = \App\Models\User::where('role', 'instructor')->count();

        // Fallback if roles aren't set or empty
        if ($totalStudents == 0) $totalStudents = \App\Models\User::count();

        return view('public.home', compact('featuredCourses', 'totalCourses', 'totalStudents', 'totalInstructors'));
    }
}
