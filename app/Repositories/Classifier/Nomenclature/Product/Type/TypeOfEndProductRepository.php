<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\TypeOfEndProduct as Model;
use App\Repositories\CoreRepository;

class TypeOfEndProductRepository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->clone()
            ->select('*')
            ->orderBy('name')
            ->get();
    }
}
