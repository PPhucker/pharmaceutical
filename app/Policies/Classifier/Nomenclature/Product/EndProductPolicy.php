<?php

namespace App\Policies\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика конечного продукта.
 */
class EndProductPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return EndProduct::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.end_product', ['admin']);
    }
}
