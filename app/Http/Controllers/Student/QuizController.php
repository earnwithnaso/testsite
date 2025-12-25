<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display the quiz to the student.
     */
    public function show(Quiz $quiz)
    {
        $user = Auth::user();

        // Check enrollment
        if (!$user->isEnrolledIn($quiz->course)) {
            return redirect()->route('courses.show', $quiz->course->slug)
                ->with('error', 'You must be enrolled to take this quiz.');
        }

        $quiz->load(['questions.options']);

        return view('student.quizzes.show', compact('quiz'));
    }

    /**
     * Submit quiz answers and calculate results.
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $user = Auth::user();
        $quiz->load('questions.options');

        $answers = $request->input('answers', []);
        $correctCount = 0;
        $totalPoints = 0;
        $earnedPoints = 0;

        foreach ($quiz->questions as $question) {
            $totalPoints += $question->points;
            $selectedOptionId = $answers[$question->id] ?? null;
            
            if ($selectedOptionId) {
                $correctOption = $question->options->where('is_correct', true)->first();
                if ($correctOption && $correctOption->id == $selectedOptionId) {
                    $correctCount++;
                    $earnedPoints += $question->points;
                }
            }
        }

        $totalQuestions = $quiz->questions->count();
        $percentage = $totalQuestions > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
        $isPassed = $percentage >= $quiz->passing_percentage;

        $result = QuizResult::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $earnedPoints,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctCount,
            'percentage' => $percentage,
            'is_passed' => $isPassed,
            'completed_at' => now(),
        ]);

        return view('student.quizzes.result', compact('quiz', 'result'));
    }
}
