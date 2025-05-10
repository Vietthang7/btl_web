<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        DB::table('vehicles')->insert([
            ['license_plate' => '30A-12345', 'owner_name' => 'Nguyễn Văn A', 'type' => 'Ô tô'],
            ['license_plate' => '51H-67890', 'owner_name' => 'Trần Thị B', 'type' => 'Xe máy'],
        ]);
    }
}