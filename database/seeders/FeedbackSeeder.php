<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feedback')->insert([
            ['order_id' => 1, "customer_id" => 1, 'rating' => 5, 'comment' => 'Great food and service!', 'created_at' => now()],
            ['order_id' => 2, "customer_id" => 2, 'rating' => 4, 'comment' => 'Tasty but a bit slow.', 'created_at' => now()],
            ['order_id' => 3, "customer_id" => 3, 'rating' => 2, 'comment' => 'Did not meet expectations.', 'created_at' => now()],
        ]);
    }
}