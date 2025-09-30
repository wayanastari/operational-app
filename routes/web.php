<?php

use App\Http\Controllers\GarageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VehicleTypesController;
use App\Http\Controllers\VehicleVariantsController;

Route::resource('/branch', BranchController::class);
Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('/garage', GarageController::class);
Route::get('garage/{id}/edit', [GarageController::class, 'edit'])->name('garage.edit');
Route::delete('/garage/{id}', [GarageController::class, 'destroy'])->name('garage.destroy');

Route::resource('/vehicle_types', VehicleTypesController::class);
Route::get('vehicle_types/{id}/edit', [GarageController::class, 'edit'])->name('vehicle_types.edit');
Route::delete('/vehicle_types/{id}', [VehicleTypesController::class, 'destroy'])->name('vehicle_types.destroy');

Route::resource('/vehicle_variants', VehicleVariantsController::class);
Route::get('vehicle_variants/{id}/edit', [VehicleVariantsController::class, 'edit'])->name('vehicle_variants.edit');
Route::delete('/vehicle_variants/{id}', [VehicleVariantsController::class, 'destroy'])->name('vehicle_variants.destroy');