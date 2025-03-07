<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Profile;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view their transactions.
     */
    public function test_user_can_view_transactions()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create(['profile_id' => $profile->id]);

        $response = $this->get(route('transactions.index'));

        $response->assertStatus(200);
        $response->assertSee($transaction->description);
    }

    /**
     * Test that a user can create a new transaction.
     */
    public function test_user_can_create_transaction()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $category = Category::factory()->create(['user_id' => $user->id]);

        $data = [
            'transaction_date' => '2025-03-07',
            'description' => 'Test Transaction',
            'type' => 'expense',
            'amount' => 100,
            'category_id' => $category->id,
        ];

        $response = $this->post(route('transactions.store'), $data);

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('success', 'Transaction ajouté avec succès !');
        $this->assertDatabaseHas('transactions', $data);
    }

    /**
     * Test that a user can update a transaction.
     */
    public function test_user_can_update_transaction()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $category = Category::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create(['profile_id' => $profile->id, 'category_id' => $category->id]);

        $updatedData = [
            'transaction_date' => '2025-03-08',
            'description' => 'Updated Transaction',
            'amount' => 200,
            'type' => 'income',
            'category_id' => $category->id,
        ];

        $response = $this->put(route('transactions.update', $transaction->id), $updatedData);

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('success', 'Transaction modifié avec succès !');
        $this->assertDatabaseHas('transactions', $updatedData);
    }

    /**
     * Test that a user can delete a transaction.
     */
    public function test_user_can_delete_transaction()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $category = Category::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create(['profile_id' => $profile->id, 'category_id' => $category->id]);

        $response = $this->delete(route('transactions.destroy', $transaction->id));

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('success', 'Transaction supprimé avec succès !');
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }

    /**
     * Test that guests cannot access the transactions page.
     */
    public function test_guest_cannot_access_transactions()
    {
        $response = $this->get(route('transactions.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test that guests cannot delete a transaction.
     */
    public function test_guest_cannot_delete_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->delete(route('transactions.destroy', $transaction->id));

        $response->assertRedirect(route('login'));
    }
}
