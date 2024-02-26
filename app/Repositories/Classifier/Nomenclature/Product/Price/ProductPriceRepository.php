<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Price;

use App\Models\Classifier\Nomenclature\Product\ProductPrice as Model;
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
