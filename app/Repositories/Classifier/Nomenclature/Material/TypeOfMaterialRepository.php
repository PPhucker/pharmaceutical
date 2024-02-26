<?php

namespace App\Repositories\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Materials\TypeOfMaterial as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TypeOfMaterialRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll()
    {
        return $this->clone()
            ->orderBy('name')
            ->get();
    }
}
