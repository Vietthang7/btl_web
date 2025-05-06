<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationSeeder extends Seeder
{
    public function run()
    {
        DB::table('violations')->insert([
            ['vehicle_id' => 1, 'violation_type' => 'Vượt đèn đỏ', 'fine_amount' => 800000, 'violation_date' => '2025-04-20 08:30:00', 'location' => 'Ngã tư Kim Mã, Hà Nội', 'status' => 'pending'],
            ['vehicle_id' => 1, 'violation_type' => 'Chạy quá tốc độ', 'fine_amount' => 500000, 'violation_date' => '2025-04-21 14:15:00', 'location' => 'Đường Nguyễn Trãi, Hà Nội', 'status' => 'paid'],
            ['vehicle_id' => 2, 'violation_type' => 'Không đội mũ bảo hiểm', 'fine_amount' => 200000, 'violation_date' => '2025-04-22 09:00:00', 'location' => 'Cầu Sài Gòn, TP.HCM', 'status' => 'pending'],
        ]);
    }
}