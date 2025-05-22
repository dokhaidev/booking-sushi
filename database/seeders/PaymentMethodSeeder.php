<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'payment_method_name' => 'Tiền mặt',
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name' => 'Chuyển khoản ngân hàng',
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name' => 'Ví điện tử Momo',
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method_name' => 'Thẻ tín dụng',
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
