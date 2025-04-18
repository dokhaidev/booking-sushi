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
<<<<<<< HEAD
        CustomerSeeder::class,
        MenuSeeder::class,
        OrderSeeder::class,
        OrderItemSeeder::class,


=======
        MenuSeeder::class,
        OrderSeeder::class,
>>>>>>> 2eac8cda036f8d463e5c05f0b033b2fe0d01ed95
    ]);
}

}
