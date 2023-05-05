<?php

namespace App\Observers\Documents\Shipment\Appendixes;

use App\Logging\Logger;
use App\Models\Documents\Shipment\Appendixes\Appendix;

class AppendixObserver
{
    /**
     * Handle the Appendix "created" event.
     *
     * @param Appendix $appendix
     *
     * @return void
     */
    public function created(Appendix $appendix)
    {
        Logger::userActionNotice('create', $appendix);
    }

    /**
     * Handle the Appendix "updated" event.
     *
     * @param Appendix $appendix
     *
     * @return void
     */
    public function updated(Appendix $appendix)
    {
        Logger::userActionNotice('update', $appendix);
    }

    /**
     * Handle the Appendix "deleted" event.
     *
     * @param Appendix $appendix
     *
     * @return void
     */
    public function deleted(Appendix $appendix)
    {
        Logger::userActionNotice('delete', $appendix);
    }

    /**
     * Handle the Appendix "restored" event.
     *
     * @param Appendix $appendix
     *
     * @return void
     */
    public function restored(Appendix $appendix)
    {
        Logger::userActionNotice('restore', $appendix);
    }
}
