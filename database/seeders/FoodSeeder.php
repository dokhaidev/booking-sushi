<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foods')->insert([
            ['category_id' => 1, 'name' => 'Coke', 'description' => 'Chilled soft drink', 'price' => 20000, 'status' => 1, 'image' => 'https://example.com/coke.jpg'],
            ['category_id' => 2, 'name' => 'Ice Cream', 'description' => 'Vanilla ice cream', 'price' => 30000, 'status' => 1, 'image' => 'https://example.com/icecream.jpg'],
            ['category_id' => 3, 'name' => 'Steak', 'description' => 'Grilled beef steak', 'price' => 150000, 'status' => 1, 'image' => 'https://example.com/steak.jpg'],
        ]);
    }
}
