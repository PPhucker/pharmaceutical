<?php

namespace App\Services\Classifier\Nomenclature\Product\Type;

use App\Repositories\Classifier\Nomenclature\Material\TypeOfMaterialRepository;
use App\Repositories\Classifier\Nomenclature\Product\Type\TypeOfAggregationRepository;
use App\Repositories\Classifier\Nomenclature\Product\Type\TypeOfEndProductRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей типов для конечной продукции.
 */
class TypeServiceDependencies extends CoreDependencyService
{
    /**
     * @param TypeOfAggregationRepository $typeOfAggregation
     * @param TypeOfEndProductRepository  $typeOfEndProduct
     * @param TypeOfMaterialRepository    $typeOfMaterial
     */
    public function __construct(
        TypeOfAggregationRepository $typeOfAggregation,
        TypeOfEndProductRepository $typeOfEndProduct,
        TypeOfMaterialRepository $typeOfMaterial
    ) {
        $this->repositories = compact(
            'typeOfAggregation',
            'typeOfEndProduct',
            'typeOfMaterial'
        );
    }
}
