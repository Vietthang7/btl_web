<?php

namespace Database\Seeders;

use App\Models\TrafficSituation;
use Illuminate\Database\Seeder;

class TrafficSituationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trafficSituations = [
            [
                'location' => 'Đường Nguyễn Trãi',
                'city' => 'Hà Nội',
                'status' => 'Ùn tắc nghiêm trọng do tai nạn lúc 7:00 sáng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location' => 'Cầu Sài Gòn',
                'city' => 'TP.HCM',
                'status' => 'Giao thông thông thoáng, không có sự cố.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location' => 'Đường Hùng Vương',
                'city' => 'Đà Nẵng',
                'status' => 'Tắc nghẽn nhẹ do công trình sửa đường.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location' => 'Đường Láng',
                'city' => 'Hà Nội',
                'status' => 'Đang có sự kiện, giao thông đông đúc.',
                'created_at' => now(),
                'updated_at' => now()->subHours(2),
            ],
            [
                'location' => 'Đường Võ Văn Kiệt',
                'city' => 'TP.HCM',
                'status' => 'Giao thông bình thường, di chuyển thuận lợi.',
                'created_at' => now(),
                'updated_at' => now()->subHours(3),
            ],
        ];

        foreach ($trafficSituations as $situation) {
            TrafficSituation::create($situation);
        }
    }
}