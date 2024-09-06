<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog\Price;

use App\Repositories\Classifier\Nomenclature\Product\Catalog\Price\ProductPriceRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей цен готовой продукции.
 */
class PriceServiceDependencies extends CoreDependencyService
{
    /**
     * @param ProductPriceRepository $retailPrice
     */
    public function __construct(
        ProductPriceRepository $retailPrice
    ) {
        $this->repositories = compact(
            'retailPrice'
        );
    }
}
