<?php

namespace App\Repositories\Classifiers\Nomenclature;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\OKEI as Model;

class OKEIRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->clone()
            ->orderBy('symbol')
            ->get();
    }
}
