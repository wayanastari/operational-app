<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle__services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained(
                table: 'vehicles', indexName: 'id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('garage_id')->constrained(
                table: 'garages', indexName: 'id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->date('service_date');
            $table->integer('last_odometer');
            $table->string('service_note');
            $table->integer('total_cost');
            $table->date('change_oil_date');
            $table->date('next_service_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle__services');
    }
};
