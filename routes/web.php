<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    // Return the welcome view for unauthenticated users
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('countries', CountryController::class)->names('countries');
    Route::resource('states', StateController::class)->names('states');
    Route::get('/get-states-by-country/{country_id}', [StateController::class, 'statesByCountry'])->name('get-states-by-country');
    Route::resource('cities', CityController::class)->names('cities');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
