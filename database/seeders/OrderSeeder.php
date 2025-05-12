<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Table;
use App\Models\Customer;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $tables = Table::all();
        $customers = Customer::all();

        // Tạo 10 đơn đặt bàn của khách đã đăng ký
        foreach (range(1, 10) as $i) {
            $customer = $customers->random();

            Order::create([
                'table_id' => $tables->random()->id,
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone ?? '090' . rand(1000000, 9999999),
                'email' => $customer->email ?? 'user' . $i . '@example.com',
                'total_price' => rand(100, 1000),
                'note' => fake()->sentence(),
                'status' => fake()->randomElement(['pending', 'confirmed', 'checked_in', 'completed', 'cancelled']),
                'reservation_date' => now()->addDays(rand(0, 14))->toDateString(),
                'reservation_time' => now()->setTime(rand(10, 20), 0)->format('H:i:s'),
                'guests' => rand(1, 10),
            ]);
        }
    }
}