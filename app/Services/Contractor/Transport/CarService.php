<?php

namespace App\Services\Contractor\Transport;

/**
 * Сервис автомобиля контрагента.
 */
class CarService extends TransportService
{
    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->car;
    }
}
