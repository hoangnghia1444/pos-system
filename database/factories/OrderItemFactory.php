<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\MenuItem;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(), 
            'menu_item_id' => MenuItem::factory(), 
            'quantity' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
