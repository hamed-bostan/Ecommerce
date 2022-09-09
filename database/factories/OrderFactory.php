<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>random_int(1,200),
            'product_name'=>fake()->name,
            'price'=>Str::random(20),
            'color'=>faker()->word,
            'quantity'=>random_int(1,200),
            'sold_count' => random_int(1,50),
        ];
    }
}
