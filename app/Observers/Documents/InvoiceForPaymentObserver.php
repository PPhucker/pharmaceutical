<?php

namespace App\Observers\Documents;

use App\Logging\Logger;
use App\Models\Documents\InvoiceForPayment;

class InvoiceForPaymentObserver
{
    /**
     * Handle the InvoiceForPayment "created" event.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return void
     */
    public function created(InvoiceForPayment $invoiceForPayment)
    {
        Logger::userActionNotice('create', $invoiceForPayment);
    }

    /**
     * Handle the InvoiceForPayment "updated" event.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return void
     */
    public function updated(InvoiceForPayment $invoiceForPayment)
    {
        Logger::userActionNotice('update', $invoiceForPayment);
    }

    /**
     * Handle the InvoiceForPayment "deleted" event.
     *
     * @param InvoiceForPayment  $invoiceForPayment
     *
     * @return void
     */
    public function deleted(InvoiceForPayment $invoiceForPayment)
    {
        Logger::userActionNotice('destroy', $invoiceForPayment);
    }

    /**
     * Handle the InvoiceForPayment "restored" event.
     *
     * @param InvoiceForPayment  $invoiceForPayment
     *
     * @return void
     */
    public function restored(InvoiceForPayment $invoiceForPayment)
    {
        Logger::userActionNotice('restore', $invoiceForPayment);
    }
}
