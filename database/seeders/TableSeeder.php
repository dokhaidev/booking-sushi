<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tables')->insert([
            [
                'table_number' => 'A1',
                'size' => 4,
                'max_guests' => 4,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'A2',
                'size' => 2,
                'max_guests' => 2,
                'status' => 'reserved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'B1',
                'size' => 6,
                'max_guests' => 6,
                'status' => 'occupied',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'B2',
                'size' => 8,
                'max_guests' => 8,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'C1',
                'size' => 4,
                'max_guests' => 4,
                'status' => 'reserved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'C2',
                'size' => 2,
                'max_guests' => 2,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'D1',
                'size' => 6,
                'max_guests' => 6,
                'status' => 'occupied',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'D2',
                'size' => 4,
                'max_guests' => 4,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'E1',
                'size' => 8,
                'max_guests' => 8,
                'status' => 'reserved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'E2',
                'size' => 2,
                'max_guests' => 2,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
