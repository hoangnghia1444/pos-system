<?php
// filepath: c:\Users\ADMIN\pos-system\app\Http\Controllers\OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DiningTable;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('diningTable', 'orderItems.menuItem')
            ->paginate(10);

        return Inertia::render('Pos/Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        $diningTables = DiningTable::all();
        $menuItems = MenuItem::all();

        return Inertia::render('Pos/Orders/Create', [
            'diningTables' => $diningTables,
            'menuItems' => $menuItems,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dining_table_id' => 'required|exists:dining_tables,id',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'dining_table_id' => $validated['dining_table_id'],
            'total_amount' => 0,
            'status' => 'pending',
        ]);

        $total = 0;
        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::find($item['menu_item_id']);
            $order->orderItems()->create([
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'price' => $menuItem->price,
            ]);
            $total += $menuItem->price * $item['quantity'];
        }
        $order->update(['total_amount' => $total]);

        return redirect()->route('orders.index')->with('success', 'Order created!');
    }
}