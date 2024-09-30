<?php

namespace App\Services\Contractor\Transport;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис транспорта.
 */
abstract class TransportService extends CrudService
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

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }
}
