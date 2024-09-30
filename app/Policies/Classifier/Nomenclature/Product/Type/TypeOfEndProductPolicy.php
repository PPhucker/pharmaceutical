<?php

namespace App\Policies\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;
use App\Policies\Classifier\Nomenclature\Product\EndProductPolicy;

/**
 * Политика типа готовой продукции.
 */
class TypeOfEndProductPolicy extends EndProductPolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return TypeOfEndProduct::class;
    }
}
