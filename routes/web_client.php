<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HotelController;

Route::get('locale/{locale}', [HotelController::class, 'locale'])->name('locale')->where('locale', '[a-z]+');

Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');