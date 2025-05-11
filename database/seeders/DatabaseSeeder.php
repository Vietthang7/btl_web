<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Vehicle;
use App\Models\Violation;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Chạy AdminSeeder
        $this->call(AdminSeeder::class);
        
        // Chạy TrafficSituationSeeder
        $this->call(TrafficSituationSeeder::class);
        
        // Kiểm tra nếu chưa có dữ liệu trong bảng owners
        if (Owner::count() == 0) {
            // Owners
            $owners = [
                ['name' => 'Nguyễn Văn A', 'email' => 'nva@example.com', 'phone' => '0901234567', 'address' => 'Hà Nội'],
                ['name' => 'Trần Thị B', 'email' => 'ttb@example.com', 'phone' => '0901234568', 'address' => 'TP.HCM'],
            ];
            foreach ($owners as $owner) {
                Owner::create($owner);
            }
        }

        // Kiểm tra nếu chưa có dữ liệu trong bảng vehicles
        if (Vehicle::count() == 0) {
            // Vehicles - Đã sửa để bỏ owner_name, sử dụng owner_id thay thế
            $vehicles = [
                ['license_plate' => '30A-12345', 'type' => 'Car', 'brand' => 'Toyota', 'model' => 'Camry', 'owner_id' => 1],
                ['license_plate' => '51H-67890', 'type' => 'Motorcycle', 'brand' => 'Honda', 'model' => 'Wave', 'owner_id' => 2],
                ['license_plate' => '29B-54321', 'type' => 'Car', 'brand' => 'Honda', 'model' => 'Civic', 'owner_id' => 1],
            ];
            foreach ($vehicles as $vehicle) {
                Vehicle::create($vehicle);
            }
        }

        // Kiểm tra nếu chưa có dữ liệu trong bảng violations
        if (Violation::count() == 0) {
            // Violations
            $violations = [
                [
                    'vehicle_id' => 1, 'violation_date' => '2025-03-15', 'violation_type' => 'Vượt đèn đỏ',
                    'fine_amount' => 800000, 'location' => 'Hà Nội', 'payment_status' => 'Paid', 'payment_method' => 'Online'
                ],
                [
                    'vehicle_id' => 1, 'violation_date' => '2025-04-10', 'violation_type' => 'Chạy quá tốc độ',
                    'fine_amount' => 1200000, 'location' => 'Hà Nội', 'payment_status' => 'Unpaid', 'payment_method' => null
                ],
                [
                    'vehicle_id' => 2, 'violation_date' => '2025-02-20', 'violation_type' => 'Không đội mũ bảo hiểm',
                    'fine_amount' => 400000, 'location' => 'TP.HCM', 'payment_status' => 'Paid', 'payment_method' => 'Offline'
                ],
            ];
            foreach ($violations as $violation) {
                Violation::create($violation);
            }
        }
    }
}