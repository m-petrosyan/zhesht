<?php

use App\Http\Controllers\Dashboard\ImageController;

Route::post('upload-image', ImageController::class)->name('upload-image')->middleware('auth');
