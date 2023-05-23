<?php

use App\Http\Controllers\Documents\Shipment\Appendixes\AppendixController as Controller;

Route::resource('appendixes', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/appendixes/{appendix}/restore', 'restore')
        ->name('appendixes.restore')
        ->withTrashed();
    Route::patch('/appendixes/approve/{appendix}', 'approve')
        ->name('appendixes.approve');
});
