<?php

namespace App\Policies\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Material\TypeOfMaterial;
use App\Policies\CorePolicy;

/**
 * Политика типа комплектующего.
 */
class TypeOfMaterialPolicy extends CorePolicy
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return TypeOfMaterial::class;
    }

    /**
     * @inheritDoc
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.material', ['admin']);
    }
}
