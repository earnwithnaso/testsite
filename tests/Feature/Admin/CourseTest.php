<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_courses_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Course::create([
            'title' => 'Test Course',
            'slug' => 'test-course',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => $admin->id,
            'difficulty_level' => 'beginner',
            'is_published' => true
        ]);

        $response = $this->actingAs($admin)->get(route('admin.courses.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Course');
    }

    public function test_admin_can_create_course()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        $response = $this->actingAs($admin)->post(route('admin.courses.store'), [
            'title' => 'New Course',
            'description' => 'Detailed description',
            'price' => 99.99,
            'instructor_id' => $admin->id,
            'difficulty_level' => 'intermediate',
            'category_id' => $category->id,
            'thumbnail' => UploadedFile::fake()->image('course.jpg'),
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.courses.index'));
        $this->assertDatabaseHas('courses', ['title' => 'New Course']);
    }
}
