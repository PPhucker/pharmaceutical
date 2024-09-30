<?php

namespace App\Services\Classifier\Nomenclature\Material;

use App\Repositories\Classifier\Nomenclature\Material\MaterialRepository;
use App\Repositories\Classifier\Nomenclature\Material\TypeOfMaterialRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис завистмостей комплектующих.
 */
class MaterialServiceDependencies extends CoreDependencyService
{
    /**
     * @param TypeOfMaterialRepository $typeOfMaterial
     * @param MaterialRepository       $material
     */
    public function __construct(
        TypeOfMaterialRepository $typeOfMaterial,
        MaterialRepository $material
    ) {
        $this->repositories = compact(
            'typeOfMaterial',
            'material'
        );
    }
}
