<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleVariant::factory()->count(5)->create();
    }
}
