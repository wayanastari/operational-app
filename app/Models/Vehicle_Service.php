<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle_Service extends Model
{
    protected $fillable= [
        'vehicle_id',
        'garage_id',
        'service_date',
        'last_odometer',
        'service_note',
        'total_cost',
        'change_oil_date',
        'next_service_date',
    ];
}
