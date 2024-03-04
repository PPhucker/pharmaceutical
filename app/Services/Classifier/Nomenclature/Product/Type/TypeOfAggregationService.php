<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;

use App\Services\CrudService;

/**
 * Сервис типа агрегации.
 */
class TypeOfAggregationService extends CrudService
{
    /**
     * @param TypeServiceDependencies $typeServiceDependencies
     */
    public function __construct(TypeServiceDependencies $typeServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies(
            [
                $typeServiceDependencies
            ]
        );
        $this->selectedRepo = $this->repositories->typeOfAggregation;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $typesOfAggregation = $this->selectedRepo->getAll();

        return compact('typesOfAggregation');
    }
}
