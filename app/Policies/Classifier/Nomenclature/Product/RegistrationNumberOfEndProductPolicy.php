<?php

namespace App\Policies\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;
use App\Policies\CorePolicy;

/**
 * Политика регистрационного номера готовой продукции.
 */
class RegistrationNumberOfEndProductPolicy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return RegistrationNumberOfEndProduct::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.end_product');
    }
}
