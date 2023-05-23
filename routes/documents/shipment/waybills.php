<?php

use App\Http\Controllers\Documents\Shipment\Waybills\WaybillController as Controller;

Route::resource('waybills', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/waybills/{waybill}/restore', 'restore')
        ->name('waybills.restore')
        ->withTrashed();
    Route::patch('/waybills/approve/{waybill}', 'approve')
        ->name('waybills.approve');
});
