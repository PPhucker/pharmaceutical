<?php

namespace App\Observers\Documents\Shipment\PackingLists;

use App\Logging\Logger;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;

class PackingListProductObserver
{
    /**
     * Handle the PackingListProduct "created" event.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return void
     */
    public function created(PackingListProduct $packingListProduct)
    {
        Logger::userActionNotice('create', $packingListProduct);
    }

    /**
     * Handle the PackingListProduct "updated" event.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return void
     */
    public function updated(PackingListProduct $packingListProduct)
    {
        Logger::userActionNotice('update', $packingListProduct);
    }

    /**
     * Handle the PackingListProduct "deleted" event.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return void
     */
    public function deleted(PackingListProduct $packingListProduct)
    {
        Logger::userActionNotice('destroy', $packingListProduct);
    }

    /**
     * Handle the PackingListProduct "restored" event.
     *
     * @param PackingListProduct $packingListProduct
     *
     * @return void
     */
    public function restored(PackingListProduct $packingListProduct)
    {
        Logger::userActionNotice('restore', $packingListProduct);
    }
}
