<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of enrolled courses.
     */
    public function index()
    {
        $user = Auth::user();
        $courses = $user->enrolledCourses()->withCount('lessons')->get();
        
        return view('student.courses.index', compact('courses'));
    }

    /**
     * Display the course player.
     */
    public function show(Course $course, Lesson $lesson = null)
    {
        $user = Auth::user();
        
        // Check if user is enrolled
        if (!$user->isEnrolledIn($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'You must be enrolled in this course to watch it.');
        }

        // Load lessons if not already loaded
        $course->load(['lessons' => function($query) {
            $query->orderBy('position', 'asc');
        }]);

        // If no lesson is selected, pick the first one or the last uncompleted one
        if (!$lesson) {
            $lesson = $course->lessons->first();
            // TODO: Logic to find the next uncompleted lesson
        }

        // Get progress for this course
        $completedLessonIds = $user->lessonProgress()
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->pluck('lesson_id')
            ->toArray();

        return view('student.courses.show', compact('course', 'lesson', 'completedLessonIds'));
    }

    /**
     * Mark a lesson as complete.
     */
    public function completeLesson(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        
        // Check if user is enrolled in the parent course
        if (!$user->isEnrolledIn($lesson->course)) {
            return back()->with('error', 'Unauthorized.');
        }

        LessonProgress::updateOrCreate(
            ['user_id' => $user->id, 'lesson_id' => $lesson->id],
            ['completed_at' => now()]
        );

        return back()->with('success', 'Lesson marked as complete!');
    }

    /**
     * Student Dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses()->withCount('lessons')->limit(3)->get();
        $totalCompleted = $user->lessonProgress()->count(); // Simplified for now
        
        return view('dashboard', compact('enrolledCourses', 'totalCompleted'));
    }
}
