<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\DiningTable;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [

            'dining_table_id' => DiningTable::factory(),
            'total_amount'    => 0, 
            'status'          => 'pending',
        ];
    }
}
