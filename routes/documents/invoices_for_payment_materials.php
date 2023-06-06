<?php

use App\Http\Controllers\Documents\InvoicesForPayment\InvoiceForPaymentMaterialController as Controller;

Route::resource('invoices_for_payment_materials', Controller::class)
    ->only(['update', 'store', 'destroy']);

Route::controller(Controller::class)->group(static function () {
    Route::post('/invoices_for_payment_materials/{invoices_for_payment_material}/restore', 'restore')
        ->name('invoices_for_payment_materials.restore')
        ->withTrashed();
});
