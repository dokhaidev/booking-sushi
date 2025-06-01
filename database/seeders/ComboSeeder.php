<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComboSeeder extends Seeder
{
    public function run()
    {
        DB::table('combos')->insert([
            [
                'name' => 'Combo Gia Đình',
                'description' => 'Combo dành cho gia đình 4 người, gồm sushi, sashimi và tempura.',
                'price' => 450000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Combo Tiết Kiệm',
                'description' => 'Combo tiết kiệm cho 2 người, gồm sushi cá hồi và cơm cuộn.',
                'price' => 220000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
