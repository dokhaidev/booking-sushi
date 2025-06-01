<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table
        DB::table('customers')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::table('customers')->insert([
            [
                'name' => 'Nguyen Van A',
                'email' => 'a@example.com',
                'phone' => '0123456789',
                'point' => 100,
                'password' => Hash::make('password123'),
                'membership_level' => 'gold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tran Thi B',
                'email' => 'b@example.com',
                'phone' => '0987654321',
                'point' => 50,
                'password' => Hash::make('password456'),
                'membership_level' => 'silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Le Van C',
                'email' => 'c@example.com',
                'phone' => '0911222333',
                'point' => 0,
                'password' => Hash::make('password789'),
                'membership_level' => 'standard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
