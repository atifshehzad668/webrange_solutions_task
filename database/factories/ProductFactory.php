<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'price'       => $this->faker->randomFloat(2, 1, 999),
            'description' => $this->faker->sentence(12),
        ];
    }
}
