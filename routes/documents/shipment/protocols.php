<?php

use App\Http\Controllers\Documents\Shipment\Protocols\ProtocolController as Controller;

Route::resource('protocols', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/protocols/{protocol}/restore', 'restore')
        ->name('protocols.restore')
        ->withTrashed();
});
