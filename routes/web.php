<?php


//Route::group(['as' => 'event.'], function () {
//});

use App\Http\Controllers\EventController;
use App\Http\Controllers\SubscribeController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');
Route::post('subscribe', [SubscribeController::class, 'store'])->name('subscribe');

require __DIR__.'/auth.php';
