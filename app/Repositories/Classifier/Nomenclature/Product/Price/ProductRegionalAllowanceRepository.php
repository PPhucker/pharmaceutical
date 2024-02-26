<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Price;

use App\Models\Classifier\Nomenclature\Product\ProductRegionalAllowance as Model;
use App\Repositories\CoreRepository;

/**
 * Репозиторий региональной надбавки готовой продукции.
 */
class ProductRegionalAllowanceRepository extends CoreRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
