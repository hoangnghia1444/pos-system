<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MenuItem;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'category' => $this->faker->randomElement(['Appetizer', 'Main', 'Dessert', 'Drink']),
            'description' => $this->faker->sentence,
        ];
    }
}
