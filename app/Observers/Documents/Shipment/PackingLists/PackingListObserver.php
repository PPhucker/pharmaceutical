<?php

namespace App\Observers\Documents\Shipment\PackingLists;

use App\Logging\Logger;
use App\Models\Documents\Shipment\PackingLists\PackingList;

class PackingListObserver
{
    private const RELATIONS = [
        'production',
    ];

    private const SHIPMENT_DOCUMENTS = [
        'bill',
        'appendix',
        'protocol',
        'waybill',
    ];

    /**
     * Handle the PackingList "created" event.
     *
     * @param PackingList $packingList
     *
     * @return void
     */
    public function created(PackingList $packingList)
    {
        Logger::userActionNotice('create', $packingList);
    }

    /**
     * Handle the PackingList "updated" event.
     *
     * @param PackingList $packingList
     *
     * @return void
     */
    public function updated(PackingList $packingList)
    {
        Logger::userActionNotice('update', $packingList);
    }

    /**
     * Handle the PackingList "deleted" event.
     *
     * @param PackingList $packingList
     *
     * @return void
     */
    public function deleted(PackingList $packingList)
    {
        foreach (self::RELATIONS as $relation) {
            foreach ($packingList->$relation()->get() as $item) {
                $item->delete();
            }
        }

        foreach (self::SHIPMENT_DOCUMENTS as $document) {
            $shipmentDocument =  $packingList->$document()->first();
            if ($shipmentDocument) {
                $shipmentDocument->delete();
            }
        }

        Logger::userActionNotice('destroy', $packingList);
    }

    /**
     * Handle the PackingList "restored" event.
     *
     * @param PackingList $packingList
     *
     * @return void
     */
    public function restored(PackingList $packingList)
    {
        foreach (self::RELATIONS as $relation) {
            foreach ($packingList->$relation()->get() as $item) {
                $item->restore();
            }
        }

        foreach (self::SHIPMENT_DOCUMENTS as $document) {
            $shipmentDocument =  $packingList->$document()->first();
            if ($shipmentDocument) {
                $shipmentDocument->restore();
            }
        }

        Logger::userActionNotice('restore', $packingList);
    }
}
