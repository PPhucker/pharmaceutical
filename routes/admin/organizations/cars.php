<?php

use App\Http\Controllers\Admin\Organizations\CarController as Controller;

Route::resource('cars', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/cars/{car}/restore', 'restore')
        ->name('cars.restore')
        ->withTrashed();
});