<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        TableSeeder::class,
        CategorySeeder::class,
        CustomerSeeder::class,
        MenuSeeder::class,
        OrderSeeder::class,
        OrderItemSeeder::class,


    ]);
}

}
