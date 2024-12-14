<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});


Route::post('/event', [BlogController::class, 'store'])->name('events.store');
Route::post('/upload-image', [BlogController::class, 'upload'])->name('upload-image');
require __DIR__.'/auth.php';
