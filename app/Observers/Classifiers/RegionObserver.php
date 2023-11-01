<?php

namespace App\Observers\Classifiers;

use App\Logging\Logger;
use App\Models\Classifiers\Region;

/**
 * Наблюдатель за регионами.
 */
class RegionObserver
{
    /**
     * Handle the Region "created" event.
     *
     * @param Region $region
     *
     * @return void
     */
    public function created(Region $region): void
    {
        Logger::userActionNotice('create', $region);
    }

    /**
     * Handle the Region "updated" event.
     *
     * @param Region $region
     *
     * @return void
     */
    public function updated(Region $region): void
    {
        Logger::userActionNotice('update', $region);
    }
}
