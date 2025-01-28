<?php


//Route::group(['as' => 'event.'], function () {
//});

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');


require __DIR__.'/auth.php';
