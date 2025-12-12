<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_pages()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Index
        $response = $this->actingAs($admin)->get(route('admin.pages.index'));
        $response->assertStatus(200);

        // Create
        $response = $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title' => 'Terms of Service',
            'content' => '<p>Terms...</p>',
            'is_published' => '1',
            'meta_title' => 'Terms'
        ]);
        
        $response->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseHas('pages', ['title' => 'Terms of Service']);

        $page = Page::where('title', 'Terms of Service')->first();

        // Update
        $response = $this->actingAs($admin)->put(route('admin.pages.update', $page), [
            'title' => 'Updated Terms',
            'content' => '<p>New content</p>'
        ]);
        
        $response->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseHas('pages', ['title' => 'Updated Terms']);

        // Delete
        $response = $this->actingAs($admin)->delete(route('admin.pages.destroy', $page));
        $response->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
    }

    public function test_public_can_view_published_page()
    {
        $page = Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => 'We are...',
            'is_published' => true
        ]);

        $response = $this->get(route('pages.show', 'about-us'));
        $response->assertStatus(200);
        $response->assertSee('About Us');
    }
}
