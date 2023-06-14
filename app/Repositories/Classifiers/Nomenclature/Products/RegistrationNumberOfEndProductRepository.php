<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct as Model;

class RegistrationNumberOfEndProductRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->clone()
            ->orderBy('number')
            ->get();
    }
}
