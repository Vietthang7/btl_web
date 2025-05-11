<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficSituation extends Model
{
    /**
     * Các thuộc tính có thể gán
     */
    protected $fillable = [
        'location',
        'status',
        'city',
        'updated_at'
    ];

    /**
     * Thuộc tính được tự động convert sang kiểu dữ liệu phù hợp
     */
    protected $casts = [
        'updated_at' => 'datetime',
    ];
}