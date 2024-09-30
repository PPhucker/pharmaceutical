<?php

namespace App\Policies\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\WholesalePrice;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика оптовой цены готовой продукции.
 */
class WholesalePricePolicy extends ProductPricePolicy
{
    use SoftDeletesPolicy;

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return WholesalePrice::class;
    }
}
