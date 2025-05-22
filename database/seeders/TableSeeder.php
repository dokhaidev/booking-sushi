<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tables')->insert([
            [
                'table_number' => 1,
                'size' => 4,
                'max_guests' => 4,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 2,
                'size' => 6,
                'max_guests' => 6,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 3,
                'size' => 2,
                'max_guests' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 4,
                'size' => 8,
                'max_guests' => 8,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 5,
                'size' => 10,
                'max_guests' => 10,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
