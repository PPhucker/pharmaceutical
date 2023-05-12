<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\Trailer;

class TrailerObserver
{
    /**
     * Handle the Trailer "created" event.
     *
     * @param Trailer $trailer
     *
     * @return void
     */
    public function created(Trailer $trailer)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $trailer);
    }

    /**
     * Handle the Trailer "updated" event.
     *
     * @param Trailer $trailer
     *
     * @return void
     */
    public function updated(Trailer $trailer)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $trailer);
    }

    /**
     * Handle the Trailer "deleted" event.
     *
     * @param Trailer  $trailer
     *
     * @return void
     */
    public function deleted(Trailer $trailer)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $trailer);
    }

    /**
     * Handle the Trailer "restored" event.
     *
     * @param  Trailer  $trailer
     *
     * @return void
     */
    public function restored(Trailer $trailer)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $trailer);
    }
}
