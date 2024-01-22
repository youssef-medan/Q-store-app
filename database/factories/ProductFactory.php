<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Category;
use \App\Models\User;

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
            'name'=>$this->faker->sentence,
            'description'=>$this->faker->text,
            'price'=>$this->faker->randomFloat(2,50,1000),
            'category_id'=> $this->faker->numberBetween(11,30),
            // 'user_id'=>User::factory() ,
        ];
    }
}
