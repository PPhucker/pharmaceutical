<?php

namespace App\Observers\Documents\InvoicesForPayment;

use App\Logging\Logger;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;

class InvoiceForPaymentProductObserver
{
    /**
     * Handle the InvoiceForPaymentProduct "created" event.
     *
     * @param InvoiceForPaymentProduct $invoiceForPaymentProduct
     *
     * @return void
     */
    public function created(InvoiceForPaymentProduct $invoiceForPaymentProduct)
    {
        Logger::userActionNotice('create', $invoiceForPaymentProduct);
    }

    /**
     * Handle the InvoiceForPaymentProduct "updated" event.
     *
     * @param InvoiceForPaymentProduct $invoiceForPaymentProduct
     *
     * @return void
     */
    public function updated(InvoiceForPaymentProduct $invoiceForPaymentProduct)
    {
        Logger::userActionNotice('update', $invoiceForPaymentProduct);
    }

    /**
     * Handle the InvoiceForPaymentProduct "deleted" event.
     *
     * @param InvoiceForPaymentProduct  $invoiceForPaymentProduct
     *
     * @return void
     */
    public function deleted(InvoiceForPaymentProduct $invoiceForPaymentProduct)
    {
        Logger::userActionNotice('destroy', $invoiceForPaymentProduct);
    }

    /**
     * Handle the InvoiceForPaymentProduct "restored" event.
     *
     * @param InvoiceForPaymentProduct  $invoiceForPaymentProduct
     *
     * @return void
     */
    public function restored(InvoiceForPaymentProduct $invoiceForPaymentProduct)
    {
        Logger::userActionNotice('restore', $invoiceForPaymentProduct);
    }
}
