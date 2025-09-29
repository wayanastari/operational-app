<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

Route::resource('/branch', BranchController::class);
Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');

Route::get('/', function () {
    return view('dashboard');
});
