<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\HotelAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['web', 'admin.auth'])->group(function () {
    Route::get('/admin/hotels', [HotelAdminController::class, 'index'])->name('admin.hotels.index');
    Route::get('/admin/hotels/create', [HotelAdminController::class, 'create'])->name('admin.hotels.create');
    Route::post('/admin/hotels', [HotelAdminController::class, 'store'])->name('admin.hotels.store');
    Route::get('/admin/hotels/{hotel}/edit', [HotelAdminController::class, 'edit'])->name('admin.hotels.edit');
    Route::put('/admin/hotels/{hotel}', [HotelAdminController::class, 'update'])->name('admin.hotels.update');
    Route::delete('/admin/hotels/{hotel}', [HotelAdminController::class, 'destroy'])->name('admin.hotels.destroy');
    Route::get('/admin/hotels/{hotel}', [HotelAdminController::class, 'show'])->name('admin.hotels.show');

    Route::get('/admin/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/create', [BookingAdminController::class, 'create'])->name('admin.bookings.create');
    Route::post('/admin/bookings', [BookingAdminController::class, 'store'])->name('admin.bookings.store');
    Route::delete('/admin/bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('admin.bookings.destroy');
});