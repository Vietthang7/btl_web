<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['license_plate', 'type', 'brand', 'model', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
}