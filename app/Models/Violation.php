<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = [
        'vehicle_id', 'violation_date', 'violation_type', 'fine_amount', 'location',
        'payment_status', 'payment_method'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}