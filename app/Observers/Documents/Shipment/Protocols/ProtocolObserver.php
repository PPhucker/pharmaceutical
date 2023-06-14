<?php

namespace App\Observers\Documents\Shipment\Protocols;

use App\Logging\Logger;
use App\Models\Documents\Shipment\Protocols\Protocol;

class ProtocolObserver
{
    /**
     * Handle the Protocol "created" event.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    public function created(Protocol $protocol)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $protocol);
    }

    /**
     * Handle the Protocol "updated" event.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    public function updated(Protocol $protocol)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $protocol);
    }

    /**
     * Handle the Protocol "deleted" event.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    public function deleted(Protocol $protocol)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $protocol);
    }

    /**
     * Handle the Protocol "restored" event.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    public function restored(Protocol $protocol)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $protocol);
    }
}
