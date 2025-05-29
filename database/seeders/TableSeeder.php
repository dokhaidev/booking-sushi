<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->insert([
            ['table_number' => 1, 'max_guests' => 4, 'status' => 'available'],
            ['table_number' => 2, 'max_guests' => 6, 'status' => 'reserved'],
            ['table_number' => 3, 'max_guests' => 2, 'status' => 'available'],
        ]);
    }
}
