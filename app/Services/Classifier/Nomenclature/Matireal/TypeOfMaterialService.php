<?php

namespace App\Services\Classifier\Nomenclature\Matireal;

use App\Services\Classifier\Nomenclature\Product\Type\TypeService;

/**
 * Сервис типа комплектующего.
 */
class TypeOfMaterialService extends TypeService
{
    /**
     * @inheritDoc
     */
    public function getIndexData(): array
    {
        $typesOfMaterials = $this->selectedRepo->getAll();

        return compact('typesOfMaterials');
    }

    /**
     * @inheritDoc
     */
    protected function selectRepository(): object
    {
        return $this->repositories->typeOfMaterial;
    }
}
