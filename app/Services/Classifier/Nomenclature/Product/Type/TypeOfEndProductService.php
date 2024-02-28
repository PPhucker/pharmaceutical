<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;

use App\Services\CrudService;

/**
 * Сервис типа готовой продукции.
 */
class TypeOfEndProductService extends CrudService
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

        $this->selectedRepo = $this->repositories->typeOfEndProduct;
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        $typesOfEndProducts = $this->selectedRepo->getAll();

        return compact('typesOfEndProducts');
    }
}
