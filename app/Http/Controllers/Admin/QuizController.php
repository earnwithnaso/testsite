<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Course $course)
    {
        $quizzes = $course->quizzes()->withCount('questions')->get();
        return view('admin.quizzes.index', compact('course', 'quizzes'));
    }

    public function create(Course $course)
    {
        $lessons = $course->lessons;
        return view('admin.quizzes.create', compact('course', 'lessons'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'lesson_id' => 'nullable|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'passing_percentage' => 'required|integer|min:0|max:100',
        ]);

        $quiz = $course->quizzes()->create($validated);

        return redirect()->route('admin.courses.quizzes.index', $course)
            ->with('success', 'Quiz created successfully.');
    }

    public function edit(Quiz $quiz)
    {
        $course = $quiz->course;
        $lessons = $course->lessons;
        return view('admin.quizzes.edit', compact('quiz', 'course', 'lessons'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'lesson_id' => 'nullable|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'passing_percentage' => 'required|integer|min:0|max:100',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.courses.quizzes.index', $quiz->course_id)
            ->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $courseId = $quiz->course_id;
        $quiz->delete();
        return redirect()->route('admin.courses.quizzes.index', $courseId)
            ->with('success', 'Quiz deleted successfully.');
    }
}
