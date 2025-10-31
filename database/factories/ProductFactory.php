<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // random product name
            'quantity' => $this->faker->numberBetween(0, 1000), // numeric quantity
            'description' => $this->faker->sentence(), // optional description
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'), // valid future date
            'status' => $this->faker->randomElement(['active', 'inactive']), // one of the allowed values
        ];
    }
}
