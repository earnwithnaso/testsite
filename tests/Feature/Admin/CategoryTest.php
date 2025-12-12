<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_categories()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Create
        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'New Category',
            'description' => 'Test Desc'
        ]);
        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'New Category', 'slug' => 'new-category']);

        $category = Category::where('slug', 'new-category')->first();

        // Update
        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'name' => 'Updated Category'
        ]);
        $this->assertDatabaseHas('categories', ['name' => 'Updated Category', 'slug' => 'updated-category']);

        // Delete
        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
