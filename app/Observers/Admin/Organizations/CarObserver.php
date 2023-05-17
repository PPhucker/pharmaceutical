<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\Car;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     *
     * @param Car $car
     *
     * @return void
     */
    public function created(Car $car)
    {
        Logger::userActionNotice(Logger::ACTION_CREATE, $car);
    }

    /**
     * Handle the Car "updated" event.
     *
     * @param Car $car
     *
     * @return void
     */
    public function updated(Car $car)
    {
        Logger::userActionNotice(Logger::ACTION_UPDATE, $car);
    }

    /**
     * Handle the Car "deleted" event.
     *
     * @param  Car  $car
     *
     * @return void
     */
    public function deleted(Car $car)
    {
        Logger::userActionNotice(Logger::ACTION_DESTROY, $car);
    }

    /**
     * Handle the Car "restored" event.
     *
     * @param  Car  $car
     *
     * @return void
     */
    public function restored(Car $car)
    {
        Logger::userActionNotice(Logger::ACTION_RESTORE, $car);
    }
}
