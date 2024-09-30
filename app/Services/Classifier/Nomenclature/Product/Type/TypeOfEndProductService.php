<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;


/**
 * Сервис типа готовой продукции.
 */
class TypeOfEndProductService extends TypeService
{
    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $typesOfEndProducts = $this->selectedRepo->getAll();

        return compact('typesOfEndProducts');
    }

    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->typeOfEndProduct;
    }
}
