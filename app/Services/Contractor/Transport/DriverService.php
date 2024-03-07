<?php

namespace App\Services\Contractor\Transport;

/**
 * Сервис водителя контрагента.
 */
class DriverService extends TransportService
{
    /**
     * @return void
     */
    protected function selectRepository(): object
    {
        return $this->repositories->driver;
    }
}
