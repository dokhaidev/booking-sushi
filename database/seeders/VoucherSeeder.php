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
                'discount_value' => 20000,
                'start_date' => '2025-05-01',
                'end_date' => '2025-06-01',
                'status' => "active",
                'usage_limit' => 50,
                "required_points" => 200
            ],
            [
                'code' => 'VOUCHER-C3D4',
                'discount_value' => 150000,
                'start_date' => '2025-05-10',
                'end_date' => '2025-06-10',
                'status' => 'expired',
                'usage_limit' => 30,
                "required_points" => 1000

            ],
            [
                'code' => 'VOUCHER-E5F6',
                'discount_value' => 100000,
                'start_date' => '2025-05-15',
                'end_date' => '2025-06-15',
                'status' => 'active',
                'usage_limit' => 20,
                "required_points" => null

            ],
        ]);
    }
}
