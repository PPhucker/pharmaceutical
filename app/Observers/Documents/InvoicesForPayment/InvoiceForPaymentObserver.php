<?php

namespace App\Observers\Documents\InvoicesForPayment;

use App\Logging\Logger;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;

class InvoiceForPaymentObserver
{
    private const RELATIONS = [
        'production',
    ];

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
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return void
     */
    public function deleted(InvoiceForPayment $invoiceForPayment)
    {
        foreach (self::RELATIONS as $relation) {
            foreach ($invoiceForPayment->$relation()->get() as $item) {
                $item->delete();
            }
        }

        /**
         * Удаление товарной накладной при удалении счета на оплату
         */
        foreach ($invoiceForPayment->packingListProdiction as $packingListProduct) {
            $packingList = $packingListProduct->packingList;
            if ($packingList->trashed()) {
                continue;
            }
            $packingList->delete();
        }

        Logger::userActionNotice('destroy', $invoiceForPayment);
    }

    /**
     * Handle the InvoiceForPayment "restored" event.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return void
     */
    public function restored(InvoiceForPayment $invoiceForPayment)
    {
        foreach (self::RELATIONS as $relation) {
            foreach ($invoiceForPayment->$relation()->get() as $item) {
                $item->restore();
            }
        }

        /**
         * Удаление товарной накладной при удалении счета на оплату
         */
        foreach ($invoiceForPayment->packingListProdiction as $packingListProduct) {
            $packingList = $packingListProduct->packingList;
            if (!$packingList->trashed()) {
                continue;
            }
            $packingList->restore();
        }
        Logger::userActionNotice('restore', $invoiceForPayment);
    }
}
