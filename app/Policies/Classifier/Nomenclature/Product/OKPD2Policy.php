<?php

namespace App\Policies\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Policies\CorePolicy;

/**
 * Политика классификатора ОКПД2.
 */
class OKPD2Policy extends CorePolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return OKPD2::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return config('classifier.nomenclature.end_product', ['admin']);
    }
}
