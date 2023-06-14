<?php

namespace App\Observers\Documents\Acts;

use App\Logging\Logger;
use App\Models\Documents\Acts\ActService;

class ActServiceObserver
{
    /**
     * Handle the ActService "created" event.
     *
     * @param ActService $actService
     *
     * @return void
     */
    public function created(ActService $actService)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $actService);
    }

    /**
     * Handle the ActService "updated" event.
     *
     * @param ActService $actService
     *
     * @return void
     */
    public function updated(ActService $actService)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $actService);
    }

    /**
     * Handle the ActService "deleted" event.
     *
     * @param ActService $actService
     *
     * @return void
     */
    public function deleted(ActService $actService)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $actService);
    }

    /**
     * Handle the ActService "restored" event.
     *
     * @param ActService $actService
     *
     * @return void
     */
    public function restored(ActService $actService)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $actService);
    }
}
