<?php

use App\Http\Controllers\Admin\Organization\Transport\DriverController as Controller;

Route::delete('/drivers/{driver}', [Controller::class, 'destroy'])
    ->name('organization.drivers.destroy');

Route::post('/drivers', [Controller::class, 'store'])
    ->name('organization.drivers.store');

Route::patch('/drivers/{driver}', [Controller::class, 'update'])
    ->name('organization.drivers.update');

Route::post('/drivers/{driver}/restore', [Controller::class, 'restore'])
    ->name('organization.drivers.restore')
    ->withTrashed();
