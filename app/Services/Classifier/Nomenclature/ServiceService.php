<?php

namespace App\Services\Classifier\Nomenclature;

use App\Services\Classifier\ClassifierServiceDependencies;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис услуги.
 */
class ServiceService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param ClassifierServiceDependencies   $classifierServiceDependencies
     * @param NomenclatureServiceDependencies $nomenclatureServiceDependencies
     */
    public function __construct(
        ClassifierServiceDependencies $classifierServiceDependencies,
        NomenclatureServiceDependencies $nomenclatureServiceDependencies
    ) {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $classifierServiceDependencies,
                $nomenclatureServiceDependencies
            ]
        );

        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->service;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $services = $this->repositories->service->getAll();
        $okeiClassifier = $this->repositories->okei->getAll();

        return compact('services', 'okeiClassifier');
    }
}
