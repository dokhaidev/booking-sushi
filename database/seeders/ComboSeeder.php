<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComboSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('combos')->insert([
            ['name' => 'Lunch Combo', 'description' => 'Includes main course and drink', 'price' => 120000, 'status' => 1],
            ['name' => 'Family Combo', 'description' => 'Meal for four people', 'price' => 300000, 'status' => 1],
            ['name' => 'Snack Combo', 'description' => 'Small meal with dessert', 'price' => 80000, 'status' => 0],
        ]);
    }
}
