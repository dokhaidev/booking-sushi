<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $menus = Menu::all();

        foreach ($orders as $order) {
            // Mỗi đơn hàng có từ 1 đến 5 món
            $items = $menus->random(rand(1, 5));

            foreach ($items as $menu) {
                $quantity = rand(1, 3);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'price' => $menu->price * $quantity,
                ]);
            }
        }
    }
}
