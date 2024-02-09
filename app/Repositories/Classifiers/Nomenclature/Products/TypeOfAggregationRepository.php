<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Nomenclature\Products\TypeOfAggregation as Model;

class TypeOfAggregationRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->clone()
            ->orderBy('code')
            ->get();
    }
}
