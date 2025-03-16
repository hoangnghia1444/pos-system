<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiningTable;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;

class PosSeeder extends Seeder
{
    public function run(): void
    {

        DiningTable::factory()->count(10)->create();


        MenuItem::factory()->count(20)->create();


        Order::factory()->count(15)->create()->each(function ($order) {

            $menuItems = \App\Models\MenuItem::inRandomOrder()->take(rand(2, 5))->get();
            $total = 0;
            foreach ($menuItems as $item) {
                $quantity = rand(1, 3);
                $order->orderItems()->create([
                    'menu_item_id' => $item->id,
                    'quantity' => $quantity,
                    'price' => $item->price,
                ]);
                $total += $item->price * $quantity;
            }
            $order->update(['total_amount' => $total]);
        });
    }
}
