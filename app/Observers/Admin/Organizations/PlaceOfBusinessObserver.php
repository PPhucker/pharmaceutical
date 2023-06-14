<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\PlaceOfBusiness;

class PlaceOfBusinessObserver
{
    private const RELATIONS = [
        'staff',
        'catalogProducts',
    ];

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
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function deleted(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('destroy', $placeOfBusiness);

        foreach (self::RELATIONS as $relation) {
            foreach ($placeOfBusiness->$relation()->get() as $item) {
                $item->delete();
            }
        }
    }

    /**
     * Handle the PlaceOfBusiness "restored" event.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return void
     */
    public function restored(PlaceOfBusiness $placeOfBusiness)
    {
        Logger::userActionNotice('restore', $placeOfBusiness);

        foreach (self::RELATIONS as $relation) {
            foreach ($placeOfBusiness->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
