<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes — Gentella ERP |-------------------------------------------------------------------------- */

// Redirect root to login or dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

// Module Routes
Route::middleware(['auth'])->group(function () {
    require __DIR__ . '/master.php';
    require __DIR__ . '/sales.php';
    require __DIR__ . '/purchasing.php';
    require __DIR__ . '/finance.php';
    require __DIR__ . '/settings.php';
});

require __DIR__ . '/auth.php';
