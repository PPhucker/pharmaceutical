<?php

namespace App\Observers\Documents\Shipment\Waybills;

use App\Logging\Logger;
use App\Models\Documents\Shipment\Waybills\Waybill;

class WaybillObserver
{
    /**
     * Handle the Waybill "created" event.
     *
     * @param Waybill $waybill
     *
     * @return void
     */
    public function created(Waybill $waybill)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $waybill);
    }

    /**
     * Handle the Waybill "updated" event.
     *
     * @param Waybill $waybill
     *
     * @return void
     */
    public function updated(Waybill $waybill)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $waybill);
    }

    /**
     * Handle the Waybill "deleted" event.
     *
     * @param Waybill $waybill
     *
     * @return void
     */
    public function deleted(Waybill $waybill)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $waybill);
    }

    /**
     * Handle the Waybill "restored" event.
     *
     * @param Waybill $waybill
     *
     * @return void
     */
    public function restored(Waybill $waybill)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $waybill);
    }
}
