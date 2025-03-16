<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DiningTable;

class DiningTableFactory extends Factory
{
    protected $model = DiningTable::class;

    public function definition()
    {
        return [
            'table_number' => 'Table ' . $this->faker->unique()->numberBetween(1, 1000),
            'capacity' => $this->faker->numberBetween(2, 10),
        ];
    }
}
