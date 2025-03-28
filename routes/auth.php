<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SubscribeController;
use App\Http\Controllers\Dashboard\TourController;


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::prefix('dashboard')->as('db.')->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('event', TourController::class)->parameters([
        'event' => 'tour',
    ]);

    Route::delete('event/{event}/delete', [EventController::class, 'destroy'])->name('event.delete');
    Route::post('event/{event}/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('event/{eventGallery}/gallery', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::delete('media/{media}', [ImageController::class, 'destroy'])->name('media.destroy');

    Route::get('/subscribers', SubscribeController::class)
        ->name('subscribers.index');

    Route::post('tour/order', [TourController::class, 'reorder'])->name('tour.reorder');

    Route::get('settings', [SettingController::class, 'create'])->name('settings.create');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
