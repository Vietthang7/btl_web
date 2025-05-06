<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['vehicle_id', 'violation_type', 'fine_amount', 'violation_date', 'location', 'status'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}