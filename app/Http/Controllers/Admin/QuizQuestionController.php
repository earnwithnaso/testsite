<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('admin.questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'nullable|boolean',
            'correct_option' => 'required|integer', // Index of the correct option
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'points' => $validated['points'],
        ]);

        foreach ($validated['options'] as $index => $optionData) {
            $question->options()->create([
                'option_text' => $optionData['text'],
                'is_correct' => $index == $validated['correct_option'],
            ]);
        }

        return redirect()->route('admin.quizzes.questions.index', $quiz)
            ->with('success', 'Question added successfully.');
    }

    public function edit(QuizQuestion $question)
    {
        $quiz = $question->quiz;
        return view('admin.questions.edit', compact('question', 'quiz'));
    }

    public function update(Request $request, QuizQuestion $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'points' => $validated['points'],
        ]);

        // Simple approach: delete and recreate options
        $question->options()->delete();
        
        foreach ($validated['options'] as $index => $optionData) {
            $question->options()->create([
                'option_text' => $optionData['text'],
                'is_correct' => $index == $validated['correct_option'],
            ]);
        }

        return redirect()->route('admin.quizzes.questions.index', $question->quiz_id)
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(QuizQuestion $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('admin.quizzes.questions.index', $quizId)
            ->with('success', 'Question deleted successfully.');
    }
}
