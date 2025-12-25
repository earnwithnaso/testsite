<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->orderBy('position')->get();
        return view('admin.lessons.index', compact('course', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_duration' => 'nullable|integer|min:0', // seconds
            'description' => 'nullable|string',
            'position' => 'nullable|integer',
            'is_free' => 'sometimes|boolean',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('lessons/videos', 'public');
            $validated['video_path'] = $path;
        }

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('lessons/pdfs', 'public');
            $validated['pdf_path'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $validated['course_id'] = $course->id;
        $validated['position'] = $validated['position'] ?? ($course->lessons()->max('position') + 1);
        $validated['is_free'] = $request->has('is_free');
        $validated['is_published'] = $request->has('is_published');
        $validated['video_duration'] = $validated['video_duration'] ?? 0;

        Lesson::create($validated);

        return redirect()->route('admin.courses.lessons.index', $course)
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        // Could be preview, but we might just use edit
        return redirect()->route('admin.lessons.edit', $lesson);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_duration' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'position' => 'nullable|integer',
            'is_free' => 'sometimes|boolean',
            'is_published' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('lessons/videos', 'public');
            $validated['video_path'] = $path;
        }

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('lessons/pdfs', 'public');
            $validated['pdf_path'] = $path;
        }

        if ($request->has('title') && $lesson->title !== $request->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        $validated['is_free'] = $request->has('is_free');
        $validated['is_published'] = $request->has('is_published');

        $lesson->update($validated);

        return redirect()->route('admin.courses.lessons.index', $lesson->course_id)
            ->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();
        
        return redirect()->route('admin.courses.lessons.index', $courseId)
            ->with('success', 'Lesson deleted successfully.');
    }
}
