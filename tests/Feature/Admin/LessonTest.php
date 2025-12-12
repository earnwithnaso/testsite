<?php

namespace Tests\Feature\Admin;

use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_lessons()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $course = Course::create([
            'title' => 'Test Course',
            'slug' => 'test-course',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => $admin->id,
            'difficulty_level' => 'beginner',
        ]);

        // List
        $response = $this->actingAs($admin)->get(route('admin.courses.lessons.index', $course));
        $response->assertStatus(200);

        // Create
        $response = $this->actingAs($admin)->post(route('admin.courses.lessons.store', $course), [
            'title' => 'Intro Lesson',
            'video_duration' => 120,
            'is_published' => '1',
            'description' => 'Lesson desc'
        ]);
        $response->assertRedirect(route('admin.courses.lessons.index', $course));
        $this->assertDatabaseHas('lessons', [
            'title' => 'Intro Lesson',
            'course_id' => $course->id
        ]);

        $lesson = Lesson::where('title', 'Intro Lesson')->first();

        // Update
        $response = $this->actingAs($admin)->put(route('admin.lessons.update', $lesson), [
            'title' => 'Updated Lesson',
            'video_duration' => 150
        ]);
        $this->assertDatabaseHas('lessons', ['title' => 'Updated Lesson']);

        // Delete
        $response = $this->actingAs($admin)->delete(route('admin.lessons.destroy', $lesson));
        $response->assertRedirect(route('admin.courses.lessons.index', $course));
        $this->assertDatabaseMissing('lessons', ['id' => $lesson->id]);
    }
}
