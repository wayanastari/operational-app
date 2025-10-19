<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class VehicleVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_vehicle_type',
        'vehicle_variant',
        'vehicle_image',
    ];
    public function vehicle_type()
    {
        return $this->belongsTo(Vehicle_types::class, 'id_vehicle_type');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'variant_id');
    }
    
}
