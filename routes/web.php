<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

Route::resource('/branch', BranchController::class);

Route::get('/', function () {
    return view('welcome');
});
