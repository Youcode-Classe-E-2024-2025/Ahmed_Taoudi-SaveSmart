<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view their profiles.
     */
    public function test_user_can_view_profiles()
    {
        $user = User::factory()->create(); // Create a user
        $profile1 = Profile::factory()->create(['user_id' => $user->id]);
        $profile2 = Profile::factory()->create(['user_id' => $user->id]);

        // Log the user in
        $this->actingAs($user);

        $response = $this->get(route('profiles.index')); // Assuming the route is named 'profiles.index'

        $response->assertStatus(200);
        $response->assertViewHas('profiles', [$profile1, $profile2]); // Assert that the profiles are returned in the view
    }
        /**
     * Test that a user can view the create profile form.
     */
    public function test_user_can_view_create_profile_form()
    {
        $user = User::factory()->create(); // Create a user

        // Log the user in
        $this->actingAs($user);

        $response = $this->get(route('profiles.create')); // Assuming the route is named 'profiles.create'

        $response->assertStatus(200);
        $response->assertViewIs('profiles.create'); // Check that the 'profiles.create' view is returned
    }
    /**
     * Test that a user can store a new profile.
     */
    public function test_user_can_create_profile()
    {
        $user = User::factory()->create(); // Create a user

        // Log the user in
        $this->actingAs($user);

        $profileData = [
            'name' => 'Test Profile',
            'pin' => '1234',
            'avatar' => null, // If you're not uploading an avatar for testing
        ];

        $response = $this->post(route('profiles.store'), $profileData); // Assuming the store route is 'profiles.store'

        $response->assertRedirect(route('profiles.index')); // Assert that the user is redirected back to the index page
        $this->assertDatabaseHas('profiles', $profileData); // Check that the profile is saved in the database
    }

    /**
     * Test that a user cannot create a profile with invalid data.
     */
    public function test_user_cannot_create_profile_with_invalid_data()
    {
        $user = User::factory()->create(); // Create a user

        // Log the user in
        $this->actingAs($user);

        // Attempt to create a profile with invalid data
        $invalidProfileData = [
            'name' => '', // Empty name should be invalid
            'pin' => '123', // Pin should have 4 characters
            'avatar' => null,
        ];

        $response = $this->post(route('profiles.store'), $invalidProfileData);

        $response->assertSessionHasErrors(['name', 'pin']); // Assert that validation errors occurred for name and pin
    }
    /**
     * Test that a user can view the dashboard with their profile.
     */
    public function test_user_can_view_dashboard_with_profile()
    {
        $user = User::factory()->create(); // Create a user
        $profile = Profile::factory()->create(['user_id' => $user->id]); // Create a profile for the user

        // Log the user in
        $this->actingAs($user);

        $response = $this->get(route('profiles.show', $profile->id)); // Assuming show route is 'profiles.show'

        $response->assertStatus(200);
        $response->assertViewHas('profile', $profile); // Assert that the profile is passed to the view
        $response->assertViewHas('transactions'); // Check if transactions are available in the view (as they are used in the controller)
        $response->assertViewHas('stats'); // Check if stats are available in the view
        $response->assertViewHas('goals'); // Check if goals are available in the view
    }

}
