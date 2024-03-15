<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => 'Product '.Str::random(4),
            'uuid' => Str::orderedUuid(),
            'price' => fake()->numberBetween(1, 1000),
            'description' => fake()->sentence(40),
            'created_at' => now()
        ];
    }
}
