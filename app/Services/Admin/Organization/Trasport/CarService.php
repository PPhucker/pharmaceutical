<?php

namespace App\Services\Admin\Organization\Trasport;

/**
 * Сервис автомобиля организации.
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
