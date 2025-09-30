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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained(
                table: 'branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('variant_id')->constrained(
                table: 'vehicle_variants')->onUpdate('cascade')->onDelete('cascade');
            $table->string('plat_number');
            $table->string('owner_name');
            $table->string('vehicle_identification_number');
            $table->string('vehicle_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
