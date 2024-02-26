<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\OKPD2 as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OKPD2Repository extends CoreRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->clone()
            ->orderBy('name')
            ->get();
    }
}
