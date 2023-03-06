<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\PlaceOfBusiness;

class PlaceOfBusinessObserver
{
    /**
     * Handle the PlaceOfBusiness "created" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function created(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('create', $placeOfBusiness);
    }

    /**
     * Handle the PlaceOfBusiness "updated" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function updated(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('update', $placeOfBusiness);
    }

    /**
     * Handle the PlaceOfBusiness "deleted" event.
     *
     * @param PlaceOfBusiness  $placeOfBusiness
     *
     * @return void
     */
    public function deleted(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('destroy', $placeOfBusiness);
    }

    /**
     * Handle the PlaceOfBusiness "restored" event.
     *
     * @param PlaceOfBusiness  $placeOfBusiness
     *
     * @return void
     */
    public function restored(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('restore', $placeOfBusiness);
    }
}
