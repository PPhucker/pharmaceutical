<?php

use App\Http\Controllers\Documents\Shipment\PackingLists\PackingListProductController as Controller;

Route::resource('packing_list_products', Controller::class)
    ->only(['update', 'store', 'destroy']);

Route::controller(Controller::class)->group(static function () {
    Route::post('/packing_list_products/{packing_list_product}/restore', 'restore')
        ->name('packing_list_products.restore')
        ->withTrashed();
});
