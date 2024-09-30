<?php

namespace App\Services\Admin\Organization\Trasport;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис транспорта организации.
 */
abstract class TransportService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param TrasportServiceDependencies $dependencies
     */
    public function __construct(TrasportServiceDependencies $dependencies)
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
