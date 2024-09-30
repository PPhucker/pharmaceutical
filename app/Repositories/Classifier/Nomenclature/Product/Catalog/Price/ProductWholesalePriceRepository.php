<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\WholesalePrice;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Репозиторий оптовой цены готовой продукции.
 */
class ProductWholesalePriceRepository extends ProductPriceRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return WholesalePrice::class;
    }

    /**
     * @inheritDoc
     */
    protected function getFilledPrice(array $validated): array
    {
        return [
            'wholesale_price' => (float)$validated['wholesale_price'],
            'wholesale_quantity' => (int)$validated['wholesale_quantity'],
        ];
    }
}
