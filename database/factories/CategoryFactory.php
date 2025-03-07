<?php


namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Associate the category with a user
            'name' => $this->faker->word(), // Random category name
        ];
    }
}
