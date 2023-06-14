<?php

namespace App\Repositories\Admin\Organizations;

use App\Models\Admin\Organizations\PlaceOfBusiness as Model;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PlaceOfBusinessRepository extends CoreRepository
{
    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(bool $withTrashed = true)
    {
        $places = $this->clone();

        if ($withTrashed) {
            $places->withTrashed();
        } else {
            $places->withoutTrashed();
        }

        return $places
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

    /**
     * @param $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function getStaff($id)
    {
        $place = $this->clone()
            ->where(
                'organizations_places_of_business.id',
                $id
            )
            ->with('staff')
            ->first();

        if (count($place->staff) === 0) {
            return collect(
                [
                    'director' => '',
                    'bookkeeper' => '',
                    'storekeeper' => ''
                ]
            );
        }

        return collect(
            [
                'director' => $place
                    ->staff
                    ->where('post', 'director')
                    ->first()
                    ->name,
                'bookkeeper' => $place
                    ->staff
                    ->where('post', 'bookkeeper')
                    ->first()
                    ->name,
                'storekeeper' => $place
                    ->staff
                    ->where('post', 'storekeeper')
                    ->first()
                    ->name,
            ]
        );
    }

    protected function getModelClass()
    {
        return Model::class;
    }
}
