<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HotelController;
use App\Http\Controllers\Client\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', [HotelController::class, 'locale'])->name('locale')->where('locale', '[a-z]+');

Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/hotels/{hotel}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/hotels/{hotel}/reserve', [ReservationController::class, 'store'])->name('reservations.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');