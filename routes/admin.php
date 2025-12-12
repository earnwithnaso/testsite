<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    
    // Course Management
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    
    // Category Management
    Route::resource('categories', CategoryController::class);

    // Lesson Management
    Route::resource('courses.lessons', \App\Http\Controllers\Admin\LessonController::class)->shallow();

    // Page Management
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    
    
    // Settings Management
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::get('settings/seo', [\App\Http\Controllers\Admin\SettingsController::class, 'seo'])->name('settings.seo');
    Route::put('settings/seo', [\App\Http\Controllers\Admin\SettingsController::class, 'updateSeo'])->name('settings.seo.update');
    Route::get('settings/about', [\App\Http\Controllers\Admin\SettingsController::class, 'about'])->name('settings.about');
    Route::put('settings/about', [\App\Http\Controllers\Admin\SettingsController::class, 'updateAbout'])->name('settings.about.update');
    Route::get('settings/env', [\App\Http\Controllers\Admin\SettingsController::class, 'env'])->name('settings.env');
});
