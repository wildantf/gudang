<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3,false),
            'slug' => $this->faker->slug(),
            'stock' => mt_rand(1,99),
            'created_by' => mt_rand(1,2)
        ];
    }
}
