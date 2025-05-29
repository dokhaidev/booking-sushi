<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComboItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('combo_items')->insert([
            ['combo_id' => 1, 'food_id' => 1, 'quantity' => 1],
            ['combo_id' => 2, 'food_id' => 2, 'quantity' => 2],
            ['combo_id' => 3, 'food_id' => 3, 'quantity' => 1],
        ]);
    }
}