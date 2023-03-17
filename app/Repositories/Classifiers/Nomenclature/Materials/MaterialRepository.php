<?php

namespace App\Repositories\Classifiers\Nomenclature\Materials;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Materials\Material as Model;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MaterialRepository extends CoreRepository
{

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
            ->orderBy('type_id')
            ->orderBy('name')
            ->withTrashed()
            ->with('type:id,name')
            ->with('okei:code,symbol')
            ->get();
    }

    /**
     * @return Collection
     */
    public function getForEndProduct()
    {
        return $this->clone()
            ->orderBy('type_id')
            ->orderBy('name')
            ->with('type:id,name')
            ->with('okei:code,symbol')
            ->get();
    }
}
