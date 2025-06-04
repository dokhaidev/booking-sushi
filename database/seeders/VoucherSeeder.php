<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'code' => 'VOUCHER-A1B2',
                'discount_value' => 20,
                'start_date' => '2025-05-01',
                'end_date' => '2025-06-01',
                'status' => "active",
                'usage_limit' => 50,
            ],
            [
                'code' => 'VOUCHER-C3D4',
                'discount_value' => 15,
                'start_date' => '2025-05-10',
                'end_date' => '2025-06-10',
                'status' => 'expired',
                'usage_limit' => 30,
            ],
            [
                'code' => 'VOUCHER-E5F6',
                'discount_value' => 10,
                'start_date' => '2025-05-15',
                'end_date' => '2025-06-15',
                'status' => 'active',
                'usage_limit' => 20,
            ],
        ]);
    }
}