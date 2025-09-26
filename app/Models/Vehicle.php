<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'branch_id',
        'variant_id',
        'plat_number',
        'owner_name',
        'vehicle_identification_number',
    ];
}
