<?php

use App\Http\Controllers\Documents\Shipment\Bills\BillController as Controller;

Route::resource('bills', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/bills/{bill}/restore', 'restore')
        ->name('bills.restore')
        ->withTrashed();
});
