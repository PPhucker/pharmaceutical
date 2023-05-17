<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\Trailer;

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
     * @param Trailer $trailer
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
     * @param Trailer $trailer
     *
     * @return void
     */
    public function restored(Trailer $trailer)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $trailer);
    }

    /**
     * Handle the Trailer "force deleted" event.
     *
     * @param Trailer $trailer
     *
     * @return void
     */
    public function forceDeleted(Trailer $trailer)
    {
        //
    }
}
