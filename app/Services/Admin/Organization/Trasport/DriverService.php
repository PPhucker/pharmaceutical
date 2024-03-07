<?php

namespace App\Services\Admin\Organization\Trasport;

/**
 * Сервис водителя орагнизации.
 */
class DriverService extends TransportService
{
    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->driver;
    }
}
