<?php

namespace App\Services\Admin\Organization\Trasport;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис трейлера организации.
 */
class TrailerService extends CrudService
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

        $this->selectedRepo = $this->repositories->trailer;
    }
}
