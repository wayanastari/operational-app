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
        Schema::create('vehicle__variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_vehicle_type')->constrained(
                table: 'vehicle_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('vehicle_variant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle__variants');
    }
};
