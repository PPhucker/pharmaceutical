<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Nomenclature\Products\TypeOfEndProduct as Model;

class TypeOfEndProductRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->clone()
            ->select('*')
            ->orderBy('name')
            ->get();
    }
}
