<?php

namespace App\Policies\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;
use App\Policies\CorePolicy;

/**
 * Политика международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProductPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return InternationalNameOfEndProduct::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.end_product', ['admin']);
    }
}
