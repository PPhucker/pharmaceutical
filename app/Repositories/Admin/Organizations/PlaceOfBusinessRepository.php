<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\PlaceOfBusiness as Model;
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
            ->orderBy('organizations_places_of_business.organization_id')
            ->orderBy('organizations_places_of_business.registered', 'desc')
            ->get();
    }

    /**
     * @param $organizationId
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getForEdit($organizationId)
    {
        return $this->clone()
            ->where(
                'organizations_places_of_business.organization_id',
                $organizationId
            )
            ->get();
    }
}
