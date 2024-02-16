<?php

namespace App\Services\Classifier\Nomenclature;

use App\Services\CrudService;

/**
 * Сервис классификатора OKEI.
 */
class OKEIService extends CrudService
{
    /**
     * @param NomenclatureServiceDependencies $nomenclatureServiceDependencies
     */
    public function __construct(NomenclatureServiceDependencies $nomenclatureServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $nomenclatureServiceDependencies
            ]
        );

        $this->selectedRepo = $this->repositories->okei;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $okeiClassifier = $this->repositories->okei->getAll();

        return compact('okeiClassifier');
    }
}
