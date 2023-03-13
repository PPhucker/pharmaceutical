<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Products\OKPD2 as Model;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OKPD2Repository extends CoreRepository
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
            ->orderBy('name')
            ->get();
    }
}
