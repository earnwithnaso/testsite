<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
  // We don't use RefreshDatabase here because we want to test against the seeded data
  // or we can use it and seed within the test. 
  // Given the environment, let's just use specific users we know exist or create new ones in transaction.
  // Actually, safer to use RefreshDatabase to avoid polluting the DB, but we need to seed the roles.

  use RefreshDatabase;

  public function test_admin_can_access_dashboard()
  {
    $admin = User::factory()->create([
      'role' => 'admin',
      'email' => 'admin_test@example.com'
    ]);

    $response = $this->actingAs($admin)->get('/admin');

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
  }

  public function test_regular_user_cannot_access_admin_dashboard()
  {
    $user = User::factory()->create([
      'role' => 'user',
      'email' => 'user_test@example.com'
    ]);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertStatus(403);
  }

  public function test_guest_is_redirected_to_login()
  {
    $response = $this->get('/admin');

    $response->assertRedirect(route('login'));
  }
}
