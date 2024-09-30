<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;

/**
 * Сервис типа агрегации.
 */
class TypeOfAggregationService extends TypeService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $typesOfAggregation = $this->selectedRepo->getAll();

        return compact('typesOfAggregation');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->typeOfAggregation;
    }
}
