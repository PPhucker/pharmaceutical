<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog\Price;

use App\Repositories\Classifier\Nomenclature\Product\Catalog\Price\ProductPriceRepository;
use App\Repositories\Classifier\Nomenclature\Product\Catalog\Price\ProductWholesalePriceRepository;
use App\Services\CoreDependencyService;

/**
 * Сервис зависимостей цен готовой продукции.
 */
class PriceServiceDependencies extends CoreDependencyService
{
    /**
     * @param ProductPriceRepository          $retailPrice
     * @param ProductWholesalePriceRepository $wholesalePrice
     */
    public function __construct(
        ProductPriceRepository $retailPrice,
        ProductWholesalePriceRepository $wholesalePrice
    ) {
        $this->repositories = compact(
            'retailPrice',
            'wholesalePrice',
        );
    }
}
