<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice as Model;
use App\Repositories\CoreRepository;

class ProductPriceRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $this->clone()
            ->withTrashed()
            ->orderBy('organization_id')
            ->get();
    }
}
