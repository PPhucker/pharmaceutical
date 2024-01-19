<?php

namespace App\Services\Contractor\Transport;

use App\Repositories\Contractor\Transport\CarRepository;
use App\Repositories\Contractor\Transport\DriverRepository;
use App\Repositories\Contractor\Transport\TrailerRepository;
use App\Services\Contractor\CoreDependencyService;

/**
 * Сервис зависимостей транспорта.
 */
class TransportServiceDependencies extends CoreDependencyService
{
    /**
     * @param CarRepository     $car
     * @param TrailerRepository $trailer
     * @param DriverRepository  $driver
     */
    public function __construct(
        CarRepository $car,
        TrailerRepository $trailer,
        DriverRepository $driver
    ) {
        $this->repositories = compact(
            'car',
            'trailer',
            'driver'
        );
    }
}
