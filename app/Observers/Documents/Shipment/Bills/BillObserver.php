<?php

namespace App\Observers\Documents\Shipment\Bills;

use App\Logging\Logger;
use App\Models\Documents\Shipment\Bills\Bill;

class BillObserver
{
    /**
     * Handle the Bill "created" event.
     *
     * @param Bill $bill
     *
     * @return void
     */
    public function created(Bill $bill)
    {
        Logger::userActionNotice('create', $bill);
    }

    /**
     * Handle the Bill "updated" event.
     *
     * @param Bill $bill
     *
     * @return void
     */
    public function updated(Bill $bill)
    {
        Logger::userActionNotice('update', $bill);
    }

    /**
     * Handle the Bill "deleted" event.
     *
     * @param Bill  $bill
     *
     * @return void
     */
    public function deleted(Bill $bill)
    {
        Logger::userActionNotice('destroy', $bill);
    }

    /**
     * Handle the Bill "restored" event.
     *
     * @param  Bill  $bill
     *
     * @return void
     */
    public function restored(Bill $bill)
    {
        Logger::userActionNotice('restore', $bill);
    }
}
