<?php

namespace App\Services\Contractor\Transport;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис водителя контрагента.
 */
class DriverService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param TransportServiceDependencies $dependencies
     */
    public function __construct(TransportServiceDependencies $dependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $dependencies
            ]
        );

        $this->selectedRepo = $this->repositories->driver;
    }
}
