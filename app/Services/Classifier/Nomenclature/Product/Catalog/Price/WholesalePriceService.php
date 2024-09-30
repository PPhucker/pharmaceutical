<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog\Price;

use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис оптовой цены готовой продукции.
 */
class WholesalePriceService extends PriceService
{
    use SoftDeletesTrait;

    /**
     * @inheritDoc
     */
    public function getIndexData(): array
    {
        $wholesalePrices = $this->selectedRepo->getAll();

        return compact('wholesalePrices');
    }

    /**
     * @inheritDoc
     */
    protected function selectRepository(): object
    {
        return $this->repositories->wholesalePrice;
    }
}
