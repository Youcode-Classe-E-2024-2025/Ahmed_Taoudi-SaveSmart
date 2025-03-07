<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view their categories.
     */
    public function test_user_can_view_categories()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $category = Category::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertSee($category->name);
    }

    /**
     * Test that a user can create a new category.
     */
    public function test_user_can_create_category()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $data = ['name' => 'New Category'];

        $response = $this->post(route('categories.store'), $data);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category ajouté avec succès !');
        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * Test that a user can update a category.
     */
    public function test_user_can_update_category()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $category = Category::factory()->create(['user_id' => $user->id]);

        $updatedData = ['name' => 'Updated Category'];

        $response = $this->put(route('categories.update', $category->id), $updatedData);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category modifié avec succès !');
        $this->assertDatabaseHas('categories', $updatedData);
    }

    /**
     * Test that a user can delete a category.
     */
    public function test_user_can_delete_category()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $category = Category::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('categories.destroy', $category->id));

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category supprimé avec succès !');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test that guests cannot access the categories page.
     */
    public function test_guest_cannot_access_categories()
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test that guests cannot delete a category.
     */
    public function test_guest_cannot_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category->id));

        $response->assertRedirect(route('login'));
    }
}
