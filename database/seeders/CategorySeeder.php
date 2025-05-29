<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Drinks', 'description' => 'Beverages and cold drinks'],
            ['name' => 'Desserts', 'description' => 'Sweet food items'],
            ['name' => 'Main Course', 'description' => 'Main dishes and meals'],
        ]);
    }
}
