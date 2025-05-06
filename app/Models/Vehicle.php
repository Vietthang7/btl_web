<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['license_plate', 'owner_name', 'vehicle_type'];

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
}