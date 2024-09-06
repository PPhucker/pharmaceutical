<?php

namespace App\Policies\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика цены готовой продукции из каталога.
 */
class ProductPricePolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return ProductPrice::class;
    }

    /**
     * @inheritDoc
     */
    protected function getRoles(): array
    {
        return config('roles.classifier.nomenclature.product_catalog.prices', ['admin']);
    }
}
