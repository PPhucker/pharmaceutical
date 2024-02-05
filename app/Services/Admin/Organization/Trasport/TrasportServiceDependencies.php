<?php

namespace App\Services\Admin\Organization\Trasport;

use App\Repositories\Admin\Organization\Transport\CarRepository;
use App\Repositories\Admin\Organization\Transport\DriverRepository;
use App\Repositories\Admin\Organization\Transport\TrailerRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей транспорта организации.
 */
class TrasportServiceDependencies extends CoreDependencyService
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
