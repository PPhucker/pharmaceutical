<?php

namespace App\Observers\Documents\InvoicesForPayment;

use App\Logging\Logger;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial;

class InvoiceForPaymentMaterialObserver
{
    /**
     * Handle the InvoiceForPaymentMaterial "created" event.
     *
     * @param InvoiceForPaymentMaterial $invoiceForPaymentMaterial
     *
     * @return void
     */
    public function created(InvoiceForPaymentMaterial $invoiceForPaymentMaterial)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $invoiceForPaymentMaterial);
    }

    /**
     * Handle the InvoiceForPaymentMaterial "updated" event.
     *
     * @param InvoiceForPaymentMaterial $invoiceForPaymentMaterial
     *
     * @return void
     */
    public function updated(InvoiceForPaymentMaterial $invoiceForPaymentMaterial)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $invoiceForPaymentMaterial);
    }

    /**
     * Handle the InvoiceForPaymentMaterial "deleted" event.
     *
     * @param InvoiceForPaymentMaterial  $invoiceForPaymentMaterial
     *
     * @return void
     */
    public function deleted(InvoiceForPaymentMaterial $invoiceForPaymentMaterial)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $invoiceForPaymentMaterial);
    }

    /**
     * Handle the InvoiceForPaymentMaterial "restored" event.
     *
     * @param InvoiceForPaymentMaterial  $invoiceForPaymentMaterial
     *
     * @return void
     */
    public function restored(InvoiceForPaymentMaterial $invoiceForPaymentMaterial)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $invoiceForPaymentMaterial);
    }
}
