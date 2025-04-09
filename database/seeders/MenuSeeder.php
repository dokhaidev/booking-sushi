<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'category_id' => 1, // Sushi Cuộn
                'name' => 'California Roll',
                'description' => 'Cuộn sushi với cua, bơ, và dưa leo.',
                'price' => 8.99,
                'status' => 'available',
                'image'=> 'california-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // Nigiri
                'name' => 'Salmon Nigiri',
                'description' => 'Lát cá hồi tươi đặt lên cơm sushi.',
                'price' => 4.50,
                'status' => 'available',
                'image'=> 'california-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, // Sashimi
                'name' => 'Tuna Sashimi',
                'description' => 'Cá ngừ thái lát tươi ngon.',
                'price' => 6.75,
                'status' => 'available',
                'image'=> 'california-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4, // Sushi Chay
                'name' => 'Avocado Maki',
                'description' => 'Sushi chay cuộn bơ, phù hợp cho người ăn chay.',
                'price' => 5.20,
                'status' => 'available',
                'image'=> 'california-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5, // Sushi Chiên
                'name' => 'Tempura Roll',
                'description' => 'Cuộn sushi chiên giòn, nhân tôm và rau củ.',
                'price' => 9.90,
                'image'=> 'california-roll.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
