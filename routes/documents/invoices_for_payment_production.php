<?php

use App\Http\Controllers\Documents\InvoicesForPayment\InvoiceForPaymentProductController as Controller;

Route::resource('invoices_for_payment_products', Controller::class)
    ->only(['update', 'store', 'destroy']);

Route::controller(Controller::class)->group(static function () {
    Route::post('/invoices_for_payment_products/{invoices_for_payment_product}/restore', 'restore')
        ->name('invoices_for_payment_products.restore')
        ->withTrashed();
});
