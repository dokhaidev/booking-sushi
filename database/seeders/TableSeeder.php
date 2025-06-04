<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->insert([
            ['table_number' => 1, 'max_guests' => 4, 'status' => 1, "size" => 4, "qr_token" =>  Str::random(32)],
            ['table_number' => 2, 'max_guests' => 6, 'status' => 1, "size" => 6, "qr_token" =>  Str::random(32)],
            ['table_number' => 3, 'max_guests' => 2, 'status' => 1, "size" => 2, "qr_token" =>  Str::random(32)],
            ['table_number' => 4, 'max_guests' => 8, 'status' => 1, "size" => 8, "qr_token" =>  Str::random(32)],
            ['table_number' => 5, 'max_guests' => 4, 'status' => 1, "size" => 4, "qr_token" =>  Str::random(32)],


        ]);
    }
}