<?php

namespace App\Services\Classifier\Nomenclature;

use App\Services\CrudService;

/**
 * Сервис номенклатуры.
 */
abstract class NomenclatureService extends CrudService
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

        $this->selectedRepo = $this->selectRepository();
    }
}
