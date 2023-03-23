<?php

namespace App\Repositories\Classifiers\Nomenclature\Materials;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Materials\TypeOfMaterial as Model;
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
