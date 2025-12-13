<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalSourceController;
// use Illuminate\Support\Facades\Artisan;


Route::get('/', [RentalSourceController::class, 'index']);


Route::get('/rentals', [RentalSourceController::class, 'index'])->name('rentals.index');



// je les ai commentées pour éviter des exécutions accidentelles, parce que c'etait juste pour que les migrations et le scraper puissent être lancés via des routes web pendant le développement.

// Route::get('/run-migrations', function () {
//     Artisan::call('migrate', ['--force' => true]);
//     return 'Migrations exécutées.';
// });


// Route::get('/run-scraper', function () {
//     Artisan::call('app:scrape-rentals');
//     return nl2br(Artisan::output());
// });


// Route::get('/clear', function () {
//     \Artisan::call('config:clear');
//     \Artisan::call('cache:clear');
//     return 'cleared';
// });

