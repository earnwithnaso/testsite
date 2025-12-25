<?php
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Create Admin
$admin = User::updateOrCreate(
    ['email' => 'admin@nazo.com'],
    [
        'name' => 'Admin Nazo',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]
);

// 2. Create Student
$student = User::updateOrCreate(
    ['email' => 'student@nazo.com'],
    [
        'name' => 'John Student',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]
);

// 3. Set Bank Details
$settings = [
    'bank_name' => 'Nazo Premium Bank',
    'account_number' => '1234567890',
    'account_name' => 'Earn With Nazo LTD',
    'currency_symbol' => '₦',
    'currency_code' => 'NGN'
];

foreach ($settings as $key => $value) {
    SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
}

// 4. Create Category
$category = Category::updateOrCreate(['slug' => 'web-dev'], ['name' => 'Web Development']);

// 5. Create Course
$course = Course::updateOrCreate(
    ['slug' => 'mastering-laravel-11'],
    [
        'title' => 'Mastering Laravel 11',
        'description' => 'Learn the latest features of Laravel 11 in this comprehensive course.',
        'price' => 5000,
        'instructor_id' => $admin->id,
        'category_id' => $category->id,
        'difficulty_level' => 'intermediate',
        'is_published' => true,
        'goals' => "Master Eloquent Relationships\nUnderstand Service Container\nBuild Robust APIs\nDeploy to Production",
    ]
);

// 6. Create Lessons
Lesson::updateOrCreate(
    ['slug' => 'intro-to-laravel-11'],
    [
        'course_id' => $course->id,
        'title' => 'Introduction to Laravel 11',
        'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'video_duration' => 120,
        'position' => 1,
        'is_published' => true,
    ]
);

Lesson::updateOrCreate(
    ['slug' => 'eloquent-basics'],
    [
        'course_id' => $course->id,
        'title' => 'Eloquent Basics',
        'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'video_duration' => 300,
        'position' => 2,
        'is_published' => true,
    ]
);

echo "Test data seeded successfully!\n";
echo "Admin: admin@nazo.com / password\n";
echo "Student: student@nazo.com / password\n";
