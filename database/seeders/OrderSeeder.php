<?php

<<<<<<< HEAD


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
                'phone' => $customer->phone ?? '090'.rand(1000000, 9999999),
                'email' => $customer->email ?? 'user'.$i.'@example.com',
                'total_price' => rand(100, 1000),
                'note' => fake()->sentence(),
                'status' => fake()->randomElement(['pending', 'confirmed', 'checked_in', 'completed', 'cancelled']),
                'reservation_date' => now()->addDays(rand(0, 14))->toDateString(),
                'reservation_time' => now()->setTime(rand(10, 20), 0)->format('H:i:s'),
                'guests' => rand(1, 10),
            ]);
        }

        // Tạo 10 đơn đặt bàn của khách chưa đăng ký
        foreach (range(1, 10) as $i) {
            Order::create([
                'table_id' => $tables->random()->id,
                'customer_id' => null,
                'name' => fake()->name(),
                'phone' => '09' . rand(10000000, 99999999),
                'email' => 'guest'.$i.'@example.com',
                'total_price' => rand(150, 1200),
                'note' => fake()->sentence(),
                'status' => fake()->randomElement(['pending', 'confirmed', 'checked_in', 'completed', 'cancelled']),
                'reservation_date' => now()->addDays(rand(0, 14))->toDateString(),
                'reservation_time' => now()->setTime(rand(10, 20), 0)->format('H:i:s'),
                'guests' => rand(1, 8),
            ]);
        }
=======
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(10)->create();
>>>>>>> 2eac8cda036f8d463e5c05f0b033b2fe0d01ed95
    }
}
