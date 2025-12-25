<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/p/{slug}', [PageController::class, 'show'])->name('pages.show'); // CMS Pages (About, Terms, etc.)

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Student\CourseController::class, 'dashboard'])->name('dashboard');

    Route::get('/checkout/{course}', [\App\Http\Controllers\Student\CheckoutController::class, 'checkout'])->name('checkout.start');
    Route::post('/checkout/{course}/bank-transfer', [\App\Http\Controllers\Student\CheckoutController::class, 'processBankTransfer'])->name('checkout.bank_transfer.process');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student Dashboard & Courses
    Route::get('/my-courses', [\App\Http\Controllers\Student\CourseController::class, 'index'])->name('student.courses.index');
    Route::get('/my-courses/{course:slug}/{lesson?}', [\App\Http\Controllers\Student\CourseController::class, 'show'])->name('student.courses.show');
    Route::post('/lessons/{lesson}/complete', [\App\Http\Controllers\Student\CourseController::class, 'completeLesson'])->name('student.lessons.complete');

    // Quizzes
    Route::get('/quizzes/{quiz}', [\App\Http\Controllers\Student\QuizController::class, 'show'])->name('student.quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [\App\Http\Controllers\Student\QuizController::class, 'submit'])->name('student.quizzes.submit');

});


require __DIR__.'/auth.php';
require __DIR__.'/debug.php';

