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
                'image' => 'california-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // Nigiri
                'name' => 'Salmon Nigiri',
                'description' => 'Lát cá hồi tươi đặt lên cơm sushi.',
                'price' => 4.50,
                'status' => 'available',
                'image' => 'salmon-nigiri.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, // Sashimi
                'name' => 'Tuna Sashimi',
                'description' => 'Cá ngừ thái lát tươi ngon.',
                'price' => 6.75,
                'status' => 'available',
                'image' => 'tuna-sashimi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4, // Sushi Chay
                'name' => 'Avocado Maki',
                'description' => 'Sushi chay cuộn bơ, phù hợp cho người ăn chay.',
                'price' => 5.20,
                'status' => 'available',
                'image' => 'avocado-maki.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5, // Sushi Chiên
                'name' => 'Tempura Roll',
                'description' => 'Cuộn sushi chiên giòn, nhân tôm và rau củ.',
                'price' => 9.90,
                'status' => 'available',
                'image' => 'tempura-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Spicy Tuna Roll',
                'description' => 'Cuộn cá ngừ cay, ăn kèm sốt mayo.',
                'price' => 7.80,
                'status' => 'available',
                'image' => 'spicy-tuna-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Ebi Nigiri',
                'description' => 'Tôm luộc đặt lên cơm sushi truyền thống.',
                'price' => 5.10,
                'status' => 'available',
                'image' => 'ebi-nigiri.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Salmon Sashimi',
                'description' => 'Cá hồi tươi cắt lát dày, hương vị béo ngậy.',
                'price' => 7.20,
                'status' => 'available',
                'image' => 'salmon-sashimi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Cucumber Roll',
                'description' => 'Sushi chay cuộn dưa leo mát lạnh.',
                'price' => 4.30,
                'status' => 'available',
                'image' => 'cucumber-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Dragon Roll',
                'description' => 'Cuộn sushi phủ lươn nướng và sốt ngọt.',
                'price' => 10.50,
                'status' => 'available',
                'image' => 'dragon-roll.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
