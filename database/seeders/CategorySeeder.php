<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Sushi Cuộn',
                'description' => 'Các loại sushi cuộn truyền thống và hiện đại.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nigiri',
                'description' => 'Sushi với lát cá tươi đặt trên cơm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sashimi',
                'description' => 'Cá sống được thái lát mỏng, không dùng cơm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Chay',
                'description' => 'Sushi không chứa thịt hay cá, thích hợp cho người ăn chay.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Chiên',
                'description' => 'Sushi được chiên giòn bên ngoài, độc đáo và hấp dẫn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
