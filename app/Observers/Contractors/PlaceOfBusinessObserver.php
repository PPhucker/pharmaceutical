<?php

namespace App\Observers\Contractors;

use App\Models\Contractors\PlaceOfBusiness;
use App\Observers\CoreObserver;
use Auth;

/**
 * Наблюдатель за местом осуществления деятельности контрагента.
 */
class PlaceOfBusinessObserver extends CoreObserver
{
    /**
     * Handle the PlaceOfBusiness "created" event.
     *
     * @param $model
     *
     * @return void
     */
    public function created($model): void
    {
        parent::created($model);

        if (Auth::user()->hasRole(['marketing', 'bookkeeping'])) {
            $model->sendEmailCreatedNotification();
        }
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
}
