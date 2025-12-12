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
        $instructors = \App\Models\User::where('role', 'admin')->get(); // Ideally admins or instructors
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
            'price' => 'required|numeric|min:0',
            'instructor_id' => 'required|exists:users,id',
            'thumbnail' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('courses', 'public');
            $validated['thumbnail_path'] = $path;
        }

        \App\Models\Course::create($validated);

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
        $instructors = \App\Models\User::where('role', 'admin')->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'instructor_id' => 'required|exists:users,id',
            'thumbnail' => 'nullable|image|max:2048',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
        ]);

        if ($request->has('title')) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }
        
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('thumbnail')) {
            // Delete old if exists (todo)
            $path = $request->file('thumbnail')->store('courses', 'public');
            $validated['thumbnail_path'] = $path;
        }

        $course->update($validated);

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
