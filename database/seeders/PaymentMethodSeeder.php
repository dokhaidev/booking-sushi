<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['payment_method_name' => 'Cash'],
            ['payment_method_name' => 'Credit Card'],
            ['payment_method_name' => 'Momo'],
        ]);
    }
}
