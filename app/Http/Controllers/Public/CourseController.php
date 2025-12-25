<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Course::with(['instructor', 'categories'])
            ->where('is_published', true);

        // Search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category Filter
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        // Difficulty Level
        if ($request->has('level') && in_array($request->input('level'), ['beginner', 'intermediate', 'advanced'])) {
            $query->where('difficulty_level', $request->input('level'));
        }

        // Price Filter
        if ($request->has('price')) {
            if ($request->input('price') === 'free') {
                $query->where('price', 0);
            } elseif ($request->input('price') === 'paid') {
                $query->where('price', '>', 0);
            }
        }

        // Rating Filter (This is heavier as it requires subquery or join, keeping it simple for now)
        if ($request->has('rating')) {
            $minRating = (int) $request->input('rating');
            $query->whereHas('reviews', function($q) use ($minRating) {
                $q->havingRaw('AVG(rating) >= ?', [$minRating]);
            });
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $courses = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::where('is_active', true)->orderBy('position')->get();
            
        return view('public.courses.index', compact('courses', 'categories'));
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
