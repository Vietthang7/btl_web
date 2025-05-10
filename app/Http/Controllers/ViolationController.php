<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Thêm import Log

/**
 * Search for violations by license plate
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
class ViolationController extends Controller
{
    public function lookup(Request $request)
    {
        $licensePlate = $request->query('license_plate');
        $vehicle = null;
        $latestViolation = null;

        if ($licensePlate) {
            $vehicle = Vehicle::where('license_plate', $licensePlate)
                ->with('violations')
                ->first();

            if ($vehicle) {
                $latestViolation = $vehicle->violations->sortByDesc('violation_date')->first();
            }
        }

        return view('lookup', compact('vehicle', 'latestViolation', 'licensePlate'));
    }
    
    public function search(Request $request)
    {
        Log::info('🔥 Đã vào hàm search với input: ' . $request->input('search'));
        
        // Phương thức search hoạt động đúng với cả GET và POST
        $search = $request->input('search');
        
        try {
            $violations = Violation::query()
                ->with(['vehicle.owner'])
                ->whereHas('vehicle', function ($query) use ($search) {
                    $query->where('license_plate', 'LIKE', "%{$search}%");
                });
                
            if (empty($search)) {
                $violations = $violations->latest()->get();
            } else {
                $violations = $violations->get();
            }
            
            Log::info('🔎 Tìm được ' . count($violations) . ' kết quả');
            
            return response()->json([
                'violations' => $violations,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Lỗi tìm kiếm: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}