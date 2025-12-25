<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Check if student has completed course and issue certificate if eligible.
     */
    public function generate(Course $course)
    {
        $user = Auth::user();

        // Check enrollment
        if (!$user->isEnrolledIn($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'You must be enrolled to receive a certificate.');
        }

        // Check if certificate already exists
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingCertificate) {
            return redirect()->route('student.certificates.show', $existingCertificate);
        }

        // Check course completion
        $totalLessons = $course->lessons()->count();
        $completedLessons = $user->lessonProgress()
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->count();

        // Check quiz completion (all quizzes must be passed)
        $requiredQuizzes = $course->quizzes()->where('is_published', true)->get();
        $passedQuizzes = 0;

        foreach ($requiredQuizzes as $quiz) {
            $result = $quiz->results()
                ->where('user_id', $user->id)
                ->where('is_passed', true)
                ->first();
            
            if ($result) {
                $passedQuizzes++;
            }
        }

        $isComplete = ($totalLessons > 0 && $completedLessons >= $totalLessons) 
                      && ($requiredQuizzes->count() == 0 || $passedQuizzes >= $requiredQuizzes->count());

        if (!$isComplete) {
            return redirect()->route('student.courses.show', $course->slug)
                ->with('error', 'You must complete all lessons and pass all quizzes to receive a certificate.');
        }

        // Generate certificate
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'certificate_number' => Certificate::generateCertificateNumber(),
            'issued_at' => now(),
        ]);

        return redirect()->route('student.certificates.show', $certificate)
            ->with('success', 'Congratulations! Your certificate has been generated.');
    }

    /**
     * Display the certificate.
     */
    public function show(Certificate $certificate)
    {
        $user = Auth::user();

        // Ensure user owns this certificate
        if ($certificate->user_id !== $user->id) {
            abort(403, 'Unauthorized access to certificate.');
        }

        return view('student.certificates.show', compact('certificate'));
    }

    /**
     * List all certificates for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        $certificates = $user->certificates()->with('course')->latest()->get();

        return view('student.certificates.index', compact('certificates'));
    }
}
