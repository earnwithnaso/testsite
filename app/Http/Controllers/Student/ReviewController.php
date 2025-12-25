<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for a course.
     */
    public function store(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        if (!$user->isEnrolledIn($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'You must be enrolled to review this course.');
        }

        // Check if user already reviewed
        $existingReview = Review::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this course.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => true, // Auto-approve for now
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}
