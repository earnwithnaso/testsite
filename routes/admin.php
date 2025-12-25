<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'staff'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Course Management
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    
    // Category Management
    Route::resource('categories', CategoryController::class);

    // Lesson Management
    Route::resource('courses.lessons', \App\Http\Controllers\Admin\LessonController::class)->shallow();

    // Quiz Management
    Route::resource('courses.quizzes', \App\Http\Controllers\Admin\QuizController::class)->shallow();
    Route::resource('quizzes.questions', \App\Http\Controllers\Admin\QuizQuestionController::class)->shallow();

    // Order Management
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/approve', [\App\Http\Controllers\Admin\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('orders/{order}/disapprove', [\App\Http\Controllers\Admin\OrderController::class, 'disapprove'])->name('orders.disapprove');

    // Page Management
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    
    // Admin ONLY Routes
    Route::middleware(['admin'])->group(function () {
        // User Management
        Route::resource('users', UserController::class);

        // Settings Management
        Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
        Route::get('settings/seo', [\App\Http\Controllers\Admin\SettingsController::class, 'seo'])->name('settings.seo');
        Route::put('settings/seo', [\App\Http\Controllers\Admin\SettingsController::class, 'updateSeo'])->name('settings.seo.update');
        Route::get('settings/about', [\App\Http\Controllers\Admin\SettingsController::class, 'about'])->name('settings.about');
        Route::put('settings/about', [\App\Http\Controllers\Admin\SettingsController::class, 'updateAbout'])->name('settings.about.update');
        Route::get('settings/env', [\App\Http\Controllers\Admin\SettingsController::class, 'env'])->name('settings.env');
    });
});
