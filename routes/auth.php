<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('settings', [SettingController::class, 'create'])->name('settings.create');


    Route::resource('event', EventController::class);
    Route::post('upload-image', ImageController::class)->name('upload-image');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
