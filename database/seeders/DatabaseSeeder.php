<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle_Variant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            BranchSeeder::class,
            GarageSeeder::class,
            VehicleVariantSeeder::class,
        ]);

    }
}
