<?php


//Route::group(['as' => 'event.'], function () {
//});

use App\Http\Controllers\EventController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TourController;

Route::get('/', [TourController::class, 'index'])->name('home');
Route::get('event/{tour}', [TourController::class, 'show'])->name('event.show');
Route::get('past', [EventController::class, 'past'])->name('past');
Route::post('subscribe', SubscribeController::class)->name('subscribe');

require __DIR__.'/auth.php';
