<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle_types extends Model
{
    protected $fillable = [
        'vehicle_type',
    ];
    public function vehicle_variants()
    {
        return $this->hasMany(VehicleVariant::class, 'id_vehicle_type');
    }
    
}
