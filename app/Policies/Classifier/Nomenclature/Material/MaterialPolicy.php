<?php

namespace App\Policies\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Material\Material;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика комплектующего.
 */
class MaterialPolicy extends TypeOfMaterialPolicy
{
    use SoftDeletesPolicy;

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Material::class;
    }
}
