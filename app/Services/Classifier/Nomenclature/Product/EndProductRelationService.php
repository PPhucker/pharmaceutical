<?php

namespace App\Services\Classifier\Nomenclature\Product;

use App\Services\CrudService;

/**
 *
 */
abstract class EndProductRelationService extends CrudService
{
    /**
     * @param EndProductServiceDependencies $endProductServiceDependencies
     */
    public function __construct(EndProductServiceDependencies $endProductServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $endProductServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }
}
