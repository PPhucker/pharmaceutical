<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog\Price;

/**
 * Сервис розничных цен.
 */
class RetailPriceService extends PriceService
{
    /**
     * @inheritDoc
     */
    public function getIndexData(): array
    {
        $retailPrices = $this->selectedRepo->getAll();

        return compact('retailPrices');
    }

    /**
     * @inheritDoc
     */
    protected function selectRepository(): object
    {
        return $this->repositories->retailPrice;
    }
}
