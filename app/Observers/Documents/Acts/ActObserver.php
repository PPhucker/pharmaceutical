<?php

namespace App\Observers\Documents\Acts;

use App\Logging\Logger;
use App\Models\Documents\Acts\Act;

class ActObserver
{
    /**
     * Handle the Act "created" event.
     *
     * @param Act $act
     *
     * @return void
     */
    public function created(Act $act)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $act);
    }

    /**
     * Handle the Act "updated" event.
     *
     * @param Act $act
     *
     * @return void
     */
    public function updated(Act $act)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $act);
    }

    /**
     * Handle the Act "deleted" event.
     *
     * @param Act $act
     *
     * @return void
     */
    public function deleted(Act $act)
    {
        foreach ($act->services()->get() as $actService) {
            $actService->delete();
        }

        Logger::userActionNotice(Logger::ACTION_DESTROY, $act);
    }

    /**
     * Handle the Act "restored" event.
     *
     * @param Act $act
     *
     * @return void
     */
    public function restored(Act $act)
    {
        foreach ($act->services()->get() as $actService) {
            $actService->restore();
        }
        Logger::userActionNotice(Logger::ACTION_RESTORE, $act);
    }
}
