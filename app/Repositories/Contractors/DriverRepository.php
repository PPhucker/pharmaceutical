<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Driver as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DriverRepository extends CoreRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return array|Application[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|Collection|mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(bool $withTrashed = true)
    {
        $drivers = $this->clone();

        $drivers->select(
            [
                'id',
                'organization_id',
                'name',
            ]
        );

        if (!$withTrashed) {
            $drivers->withoutTrashed();
        }

        return $drivers
            ->get();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
