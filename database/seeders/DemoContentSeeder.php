<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Settings
        $settings = [
            'site_name' => 'Earn With Nazo',
            'site_email' => 'admin@earnwithnazo.com',
            'currency_code' => 'USD',
            'currency_symbol' => '$',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Users (Instructor)
        $instructor = User::firstOrCreate(
            ['email' => 'instructor@earnwithnazo.com'],
            [
                'name' => 'Nazo Instructor',
                'password' => bcrypt('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
            ]
        );

        // 3. Categories
        $categories = ['Development', 'Business', 'Design', 'Marketing'];
        $createdCategories = [];

        foreach ($categories as $catName) {
            $createdCategories[] = Category::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName, 'description' => "Learn everything about $catName"]
            );
        }

        // 4. Courses
        $coursesData = [
            [
                'title' => 'Complete Web Development Bootcamp',
                'description' => 'Become a full-stack web developer with just one course. HTML, CSS, Javascript, Node, React, MongoDB, Web3 and DApps',
                'price' => 99.00,
                'difficulty_level' => 'beginner',
                'thumbnail_path' => null, // Or a placeholder path
            ],
            [
                'title' => 'Advanced Laravel Architecture',
                'description' => 'Deep dive into Laravel internals, service containers, and advanced design patterns for scalable apps.',
                'price' => 149.00,
                'difficulty_level' => 'advanced',
                'thumbnail_path' => null,
            ],
            [
                'title' => 'Digital Marketing Mastery',
                'description' => 'Master the art of digital marketing, SEO, and social media strategies to grow any business.',
                'price' => 49.00,
                'difficulty_level' => 'beginner',
                'thumbnail_path' => null,
            ],
            [
                'title' => 'UI/UX Design Fundamentals',
                'description' => 'Learn to design beautiful interfaces and user experiences using Figma and Adobe XD.',
                'price' => 79.00,
                'difficulty_level' => 'intermediate',
                'thumbnail_path' => null,
            ]
        ];

        foreach ($coursesData as $index => $data) {
            $course = Course::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . uniqid(),
                'description' => $data['description'],
                'price' => $data['price'],
                'difficulty_level' => $data['difficulty_level'],
                'instructor_id' => $instructor->id,
                'is_published' => true,
                'thumbnail_path' => $data['thumbnail_path'],
            ]);

            // Assign random category
            $course->categories()->attach($createdCategories[$index % count($createdCategories)]);

            // 5. Lessons
            for ($i = 1; $i <= 5; $i++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => "Lesson $i: Introduction to " . substr($course->title, 0, 10),
                    'slug' => Str::slug("Lesson $i " . $course->id),
                    'video_url' => 'https://www.youtube.com/watch?v=ScMzIvxBSi4', // Placeholder video
                    'video_duration' => rand(300, 1200),
                    'position' => $i,
                    'is_published' => true,
                    'is_free' => $i === 1, // First lesson is free (preview)
                    'description' => 'This is a sample lesson description.',
                ]);
            }
        }

        // 6. CMS Pages
        $pages = [
            'About Us' => '<h1>About Us</h1><p>We are a leading education platform...</p>',
            'Terms of Service' => '<h1>Terms</h1><p>By using our site, you agree to...</p>',
            'Privacy Policy' => '<h1>Privacy</h1><p>We respect your data...</p>',
        ];

        foreach ($pages as $title => $content) {
            Page::firstOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'content' => $content,
                    'is_published' => true,
                    'meta_title' => $title . ' - Earn With Nazo',
                ]
            );
        }
    }
}
