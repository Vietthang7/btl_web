<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

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
}