<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'cost_price' => $this->faker->randomFloat(2, 1000, 100000),
            'selling_price' => $this->faker->randomFloat(2, 1000, 100000),
            'profit' => $this->faker->randomFloat(2, 1000, 100000),
            'stock' => $this->faker->numberBetween(5, 100),
            'category_id' => $this->faker->numberBetween(1, 3),
            'img' => fake()->randomElement(
                [
                    'https://images.unsplash.com/photo-1743633663138-7aa66b90e483'.
                    'https://images.unsplash.com/photo-1751980105043-2bf9dadd80a3',
                    'https://plus.unsplash.com/premium_photo-1738449258742-f98da1490e2d'
                ]),
            'is_active' => $this->faker->boolean()
        ];
    }
}
