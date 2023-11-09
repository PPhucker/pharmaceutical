<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Products\ProductRegionalAllowance as Model;

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
