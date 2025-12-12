<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalSourceController;

Route::get('/', [RentalSourceController::class, 'index']);


Route::get('/rentals', [RentalSourceController::class, 'index'])->name('rentals.index');
