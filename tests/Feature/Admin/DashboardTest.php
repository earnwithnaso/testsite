<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_regular_user_cannot_access_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)
            ->get('/admin');

        $response->assertStatus(403);
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('login'));
    }
}
