<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle_Service>
 */
class VehicleServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'garage_id' => \App\Models\Garage::factory(),
            'service_date' => $this->faker->date(),
            'last_odometer' => $this->faker->numberBetween(1000, 100000),
            'service_note' => $this->faker->sentence(),
            'total_cost' => $this->faker->randomFloat(2, 50, 5000),
            'change_oil_date' => $this->faker->date(),
            'next_service_date' => $this->faker->date(),
        ];
    }
}
