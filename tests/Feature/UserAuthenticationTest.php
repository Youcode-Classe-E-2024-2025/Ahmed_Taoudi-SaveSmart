<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'family_account' => 'John Doe',
            'user_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'pin' => '0000',
            'password_confirmation' => 'password123',
        ]);

        // Assert that the user was redirected (i.e., successful registration)
        $response->assertStatus(302);
        
        // Check if the user was created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('profiles.index'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest(); // Ensure the user is not authenticated
    }

    /** @test */
    public function user_can_logout()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Log in the user
        $this->actingAs($user);

        // Perform logout
        $response = $this->get(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest(); // Ensure the user is logged out
    }

    /** @test */
    public function user_is_redirected_if_already_authenticated()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        // Attempt to access the login page
        $response = $this->get(route('login'));
        $response->assertRedirect(route('profiles.index')); // Should redirect to profiles if logged in
    }

    /** @test */
    public function guest_cannot_access_protected_routes()
    {
        $response = $this->get(route('profiles.index')); // Protected route that requires authentication
        $response->assertRedirect(route('login'));
    }
}

