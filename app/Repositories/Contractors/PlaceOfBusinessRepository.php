<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\PlaceOfBusiness as Model;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PlaceOfBusinessRepository extends CoreRepository
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
            ->orderBy('contractors_places_of_business.registered')
            ->get();
    }
}
