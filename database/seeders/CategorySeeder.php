<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Truncate foods first to avoid foreign key constraint errors


        DB::table('categories')->insert([
            [
                'name' => 'Sushi',
                'description' => 'Các loại sushi truyền thống và hiện đại.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sashimi',
                'description' => 'Các loại sashimi tươi ngon.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tempura',
                'description' => 'Các món chiên tempura giòn rụm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Đồ uống',
                'description' => 'Nước ngọt, trà, rượu sake...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tráng miệng',
                'description' => 'Các món tráng miệng ngọt ngào.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Món chính',
                'description' => 'Các món ăn chính phong phú.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        /**
         * Run the database seeds.
         */
    }
}