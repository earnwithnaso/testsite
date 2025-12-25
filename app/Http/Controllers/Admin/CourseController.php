<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = \App\Models\Course::with('instructor')
            ->latest()
            ->paginate(10);
            
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = \App\Models\User::whereIn('role', ['admin', 'instructor'])->get();
        $categories = \App\Models\Category::all();
        return view('admin.courses.create', compact('instructors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'instructor_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'stripe_price_id' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'goals' => 'nullable|string',
            'preview_video_url' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'duration_hours' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');
        
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            $validated['thumbnail_path'] = $path;
        }

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('courses/pdfs', 'public');
            $validated['pdf_path'] = $path;
        }

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('courses/videos', 'public');
            $validated['video_path'] = $path;
        }

        $course = \App\Models\Course::create($validated);

        if ($request->filled('category_id')) {
            $course->categories()->sync([$request->category_id]);
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Course $course)
    {
        $instructors = \App\Models\User::whereIn('role', ['admin', 'instructor'])->get();
        $categories = \App\Models\Category::all();
        return view('admin.courses.edit', compact('course', 'instructors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'instructor_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'stripe_price_id' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'goals' => 'nullable|string',
            'preview_video_url' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'duration_hours' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        if ($request->has('title')) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }
        
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('thumbnail')) {
            // Delete old if exists (todo)
            $path = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            $validated['thumbnail_path'] = $path;
        }

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('courses/pdfs', 'public');
            $validated['pdf_path'] = $path;
        }

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('courses/videos', 'public');
            $validated['video_path'] = $path;
        }

        $course->update($validated);

        if ($request->filled('category_id')) {
            $course->categories()->sync([$request->category_id]);
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function publish(\App\Models\Course $course)
    {
        $course->update(['is_published' => true]);
        return back()->with('success', 'Course published!');
    }
}
