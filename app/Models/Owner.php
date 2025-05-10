<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}