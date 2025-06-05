<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    public function run()
    {
        DB::table('foods')->insert([
            [
                'category_id' => 1,
                'name' => 'Sushi Cá Hồi',
                'price' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Sashimi Bạch Tuộc',
                'price' => 135000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Tempura Tôm',
                'price' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Cơm cuộn California',
                'price' => 110000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
