<?php

namespace App\Services\Contractor\Transport;

use App\Repositories\Contractors\Transport\CarRepository;
use App\Repositories\Contractors\Transport\DriverRepository;
use App\Repositories\Contractors\Transport\TrailerRepository;
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
