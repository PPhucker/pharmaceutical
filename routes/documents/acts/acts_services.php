<?php

use App\Http\Controllers\Documents\Acts\ActServiceController as Controller;

Route::resource('act_services', Controller::class)
    ->only(['update', 'store', 'destroy']);

Route::controller(Controller::class)->group(static function () {
    Route::post('/act_services/{act_service}/restore', 'restore')
        ->name('act_services.restore')
        ->withTrashed();
});
