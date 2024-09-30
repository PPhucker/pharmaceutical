<?php

namespace App\Policies\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Policies\CorePolicy;

/**
 * Политика типа агрегации готовой продукции.
 */
class TypeOfAggregationPolicy extends CorePolicy
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return TypeOfAggregation::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.product_catalog', ['admin']);
    }
}
