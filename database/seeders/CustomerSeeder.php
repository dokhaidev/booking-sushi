<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
{
    foreach (range(1, 10) as $i) {
        Customer::create([
            'name' => fake()->name(),
            'phone' => '09' . rand(10000000, 99999999),
            'email' => 'customer' . $i . '@example.com',
            'password' => bcrypt('password123')
            ]);
    }
}
}
