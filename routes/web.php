<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});


Route::post('/event', [EventController::class, 'store'])->name('events.store');
Route::post('/upload-image', [EventController::class, 'upload'])->name('upload-image');
require __DIR__.'/auth.php';
