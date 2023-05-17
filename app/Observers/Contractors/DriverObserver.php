<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\Driver;

class DriverObserver
{
    /**
     * Handle the Driver "created" event.
     *
     * @param Driver $driver
     *
     * @return void
     */
    public function created(Driver $driver)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $driver);
    }

    /**
     * Handle the Driver "updated" event.
     *
     * @param Driver $driver
     *
     * @return void
     */
    public function updated(Driver $driver)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $driver);
    }

    /**
     * Handle the Driver "deleted" event.
     *
     * @param Driver  $driver
     *
     * @return void
     */
    public function deleted(Driver $driver)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $driver);
    }

    /**
     * Handle the Driver "restored" event.
     *
     * @param  Driver  $driver
     *
     * @return void
     */
    public function restored(Driver $driver)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $driver);
    }
}
