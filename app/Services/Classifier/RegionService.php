<?php

namespace App\Services\Classifier;

use App\Services\CrudService;

/**
 * Сервис региона.
 */
class RegionService extends CrudService
{
    /**
     * @param ClassifierServiceDependencies $classifierServiceDependencies
     */
    public function __construct(ClassifierServiceDependencies $classifierServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $classifierServiceDependencies
            ]
        );

        $this->selectedRepo = $this->repositories->region;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $regions = $this->repositories->region->getAll();

        return compact('regions');
    }
}
