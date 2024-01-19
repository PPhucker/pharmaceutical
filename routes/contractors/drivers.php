<?php

use App\Http\Controllers\Contractor\Transport\DriverController as Controller;

Route::resource('drivers', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/drivers/{driver}/restore', 'restore')
        ->name('drivers.restore')
        ->withTrashed();
});
