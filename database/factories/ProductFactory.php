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
        'name' => fake()->words(2, true),
        'description' => fake()->sentence(),
        'price' => fake()->randomFloat(2, 100, 1000),
        'stock' => fake()->numberBetween(5, 100),
        'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? \App\Models\Category::factory(), // smart fallback
    ];
}

}
