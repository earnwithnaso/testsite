<?php

namespace Tests\Feature\Public;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicCourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_courses_index()
    {
        Course::create([
            'title' => 'Published Course',
            'slug' => 'published-course',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => User::factory()->create()->id,
            'difficulty_level' => 'beginner',
            'is_published' => true
        ]);

        $response = $this->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertSee('Published Course');
    }

    public function test_guest_cannot_view_unpublished_course()
    {
        Course::create([
            'title' => 'Draft Course',
            'slug' => 'draft-course',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => User::factory()->create()->id,
            'difficulty_level' => 'beginner',
            'is_published' => false
        ]);

        $response = $this->get(route('courses.index'));
        $response->assertDontSee('Draft Course');

        $response = $this->get(route('courses.show', 'draft-course'));
        $response->assertStatus(404);
    }

    public function test_guest_can_view_course_details()
    {
        $course = Course::create([
            'title' => 'Great Course',
            'slug' => 'great-course',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => User::factory()->create()->id,
            'difficulty_level' => 'beginner',
            'is_published' => true
        ]);

        $response = $this->get(route('courses.show', 'great-course'));

        $response->assertStatus(200);
        $response->assertSee('Great Course');
        $response->assertSee('Login to Enroll');
    }

    public function test_authenticated_user_can_see_enroll_button()
    {
        $user = User::factory()->create();
        $course = Course::create([
            'title' => 'Great Course',
            'slug' => 'great-course-auth',
            'description' => 'Desc',
            'price' => 10,
            'instructor_id' => User::factory()->create()->id,
            'difficulty_level' => 'beginner',
            'is_published' => true
        ]);

        $response = $this->actingAs($user)->get(route('courses.show', 'great-course-auth'));

        $response->assertStatus(200);
        $response->assertSee('Enroll Now');
    }
}
