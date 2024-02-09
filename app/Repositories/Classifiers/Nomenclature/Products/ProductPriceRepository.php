<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Nomenclature\Products\ProductPrice as Model;

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
