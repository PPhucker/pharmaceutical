<?php

namespace App\Observers\Classifiers\Nomenclature\Services;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Services\Service;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     *
     * @param Service $service
     *
     * @return void
     */
    public function created(Service $service)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $service);
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param Service $service
     *
     * @return void
     */
    public function updated(Service $service)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $service);
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param Service $service
     *
     * @return void
     */
    public function deleted(Service $service)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $service);
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param Service $service
     *
     * @return void
     */
    public function restored(Service $service)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $service);
    }
}
