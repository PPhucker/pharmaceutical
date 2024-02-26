<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct as Model;
use App\Repositories\CoreRepository;

class RegistrationNumberOfEndProductRepository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->clone()
            ->orderBy('number')
            ->get();
    }
}
