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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/checkout/{course}', [\App\Http\Controllers\Student\CheckoutController::class, 'checkout'])->name('checkout.start');
    Route::get('/checkout/success', [\App\Http\Controllers\Student\CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
require __DIR__.'/debug.php';

