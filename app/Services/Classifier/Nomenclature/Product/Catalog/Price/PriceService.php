<?php

namespace App\Services\Classifier\Nomenclature\Product\Catalog\Price;

use App\Services\CrudService;

/**
 * Абстрактный сервис цен.
 */
abstract class PriceService extends CrudService
{
    /**
     * @param PriceServiceDependencies $priceServiceDependencies
     */
    public function __construct(PriceServiceDependencies $priceServiceDependencies)
    {
        $this->repositories = $this->getRepositoriesFromDependencies([
            $priceServiceDependencies
        ]);

        $this->selectedRepo = $this->selectRepository();
    }
}
