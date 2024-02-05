<?php

use App\Http\Controllers\Admin\Organization\Transport\CarController as Controller;

Route::delete('/cars/{car}', [Controller::class, 'destroy'])
    ->name('organization.cars.destroy');

Route::post('/cars', [Controller::class, 'store'])
    ->name('organization.cars.store');

Route::patch('/cars/{car}', [Controller::class, 'update'])
    ->name('organization.cars.update');

Route::post('/cars/{car}/restore', [Controller::class, 'restore'])
    ->name('organization.cars.restore')
    ->withTrashed();
