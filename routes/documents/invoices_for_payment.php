<?php

use App\Http\Controllers\Documents\InvoicesForPayment\InvoiceForPaymentController as Controller;

Route::resource('invoices_for_payment', Controller::class)
    ->except(['create', 'show'])
    ->parameter('invoices_for_payment', 'invoice_for_payment');

Route::controller(Controller::class)->group(static function () {
    Route::post('/invoices_for_payment/{invoice_for_payment}/restore', 'restore')
        ->name('invoices_for_payment.restore')
        ->withTrashed();
    Route::get('invoices_for_payment/{contractor}/create', 'create')
        ->name('invoices_for_payment.create');
});
