<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\TypeOfAggregation as Model;
use App\Repositories\CoreRepository;

class TypeOfAggregationRepository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->clone()
            ->orderBy('code')
            ->get();
    }
}
