<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

//Popular Stations on Home Page/
Route::get('/', function () {
    $popularStations = \App\Models\Station::take(10)->get();

});

//Dashboard Route/
Route::get('/dashboard', [StationController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


//Profile Routes/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Station Routes/
Route::get('/stations', [StationController::class, 'index'])->name('stations.index');
Route::post('/stations', [StationController::class, 'store'])->name('stations.store');
Route::get('/stations/create', [StationController::class, 'create'])->name('stations.create');
Route::get('/stations/{station}/book', [StationController::class, 'showBook'])->name('stations.showBook');

//Booking Route/
Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

//Booking Status and Charging Routes/
Route::get('/bookings/{booking}/status', [BookingController::class, 'showStatus'])->name('bookings.status');
Route::post('/bookings/{booking}/start', [App\Http\Controllers\BookingController::class, 'startCharging'])->name('bookings.start');
Route::post('/bookings/{booking}/stop', [App\Http\Controllers\BookingController::class, 'stopCharging'])->name('bookings.stop');
