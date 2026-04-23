<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        $popularStations = \App\Models\Station::take(10)->get();

        $monthlyKwh = 0;
        $monthlyCost = 0;

        if (auth()->check()) {
            $summary = \App\Models\Booking::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->whereMonth('ended_at', now()->month)
                ->whereYear('ended_at', now()->year)
                ->selectRaw('SUM(kwh_charged) as total_kwh, SUM(amount_charged) as total_cost')
                ->first();

            $monthlyKwh = $summary->total_kwh ?? 0;
            $monthlyCost = $summary->total_cost ?? 0;
        }

        return view('welcome', compact('popularStations', 'monthlyKwh', 'monthlyCost'));
    } catch (\Exception $e) {
        return "Database connection error: " . $e->getMessage();
    }
});

//Dashboard Route/
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


//Profile Routes/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Static Pages
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/about', 'pages.about')->name('about');

//Station Routes/
Route::get('/stations', [StationController::class, 'index'])->name('stations.index');
Route::post('/stations', [StationController::class, 'store'])->name('stations.store');
Route::get('/stations/create', [StationController::class, 'create'])->name('stations.create');
Route::get('/stations/{station}/book', [StationController::class, 'showBook'])->name('stations.showBook');
Route::delete('/stations/{station}', [StationController::class, 'destroy'])->name('stations.destroy');
Route::patch('/stations/{station}/toggle', [StationController::class, 'toggleAvailability'])->name('stations.toggle');
Route::patch('/stations/{station}', [StationController::class, 'update'])->name('stations.update');

//Booking Route/
Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

//Booking Status, Charging, and Payment Routes/
Route::middleware('auth')->group(function () {
    Route::get('/bookings/{booking}/status', [BookingController::class, 'showStatus'])->name('bookings.status');
    Route::post('/bookings/{booking}/start', [BookingController::class, 'startCharging'])->name('bookings.start');
    Route::post('/bookings/{booking}/stop', [BookingController::class, 'stopCharging'])->name('bookings.stop');
    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/bookings/{booking}/payment', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/bookings/{booking}/payment-success', [PaymentController::class, 'success'])->name('payment.success');
});