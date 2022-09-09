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
//            'product_name'=>fake()->name,
//            'price'=>Str::random(20),
//            'color'=> $faker ->word,
//            'stock'=>faker()=>random_int(1,50),
//            'quantity'=>random_int(1,200),
//            'sales_number' => random_int(1,50),
//            'user_id'=>random_int(1,200),
        ];
    }
}
