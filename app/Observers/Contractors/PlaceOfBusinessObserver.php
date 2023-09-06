<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\PlaceOfBusiness;
use Auth;

/**
 * Наблюдатель за местом осуществления деятельности контрагента.
 */
class PlaceOfBusinessObserver
{
    /**
     * Handle the PlaceOfBusiness "created" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function created(PlaceOfBusiness $placeOfBusiness): void
    {
        Logger::userActionNotice('create', $placeOfBusiness);

        if (Auth::user()->hasRole(['marketing', 'bookkeeping'])) {
            $placeOfBusiness->sendEmailCreatedNotification();
        }
    }

    /**
     * Handle the PlaceOfBusiness "updated" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function updated(PlaceOfBusiness $placeOfBusiness): void
    {
        Logger::userActionNotice('update', $placeOfBusiness);
    }

    /**
     * Handle the PlaceOfBusiness "updating" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function updating(PlaceOfBusiness $placeOfBusiness): void
    {
        $changes = [];

        $dirty = $placeOfBusiness->getDirty();

        foreach ($dirty as $key => $item) {
            if ($key === 'address' || $key === 'index') {
                $changes[$key] = $item;
            }
        }
        if (count($changes) && Auth::user()->hasRole(['marketing', 'bookkeeping'])) {
            $placeOfBusiness->sendEmailUpdatedNotification($changes);
        }
    }

    /**
     * Handle the PlaceOfBusiness "deleted" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function deleted(PlaceOfBusiness $placeOfBusiness): void
    {
        Logger::userActionNotice('destroy', $placeOfBusiness);
    }

    /**
     * Handle the PlaceOfBusiness "restored" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function restored(PlaceOfBusiness $placeOfBusiness): void
    {
        Logger::userActionNotice('restore', $placeOfBusiness);
    }
}
