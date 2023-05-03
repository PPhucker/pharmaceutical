<?php

use App\Http\Controllers\Documents\Shipment\PackingLists\PackingListController as Controller;

Route::resource('packing_lists', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/packing_lists/{packing_list}/restore', 'restore')
        ->name('packing_lists.restore')
        ->withTrashed();
    Route::post('/packing_lists/redirect', 'redirect')
        ->name('packing_lists.redirect');
});
