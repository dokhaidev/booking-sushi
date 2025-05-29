<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CustomerSeeder::class,
            // PaymentMethodSeeder::class,
            VoucherSeeder::class
            // CategorySeeder::class,
            // FoodSeeder::class,
            // ComboSeeder::class,
            // ComboItemSeeder::class,
            // OrderSeeder::class,
            // OrderItemSeeder::class,
            // OrderComboItemSeeder::class,
            // TableSeeder::class,
            // OrderTableSeeder::class,
            // FeedbackSeeder::class,
        ]);
    }
}
