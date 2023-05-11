<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\Driver as Model;
use Illuminate\Contracts\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DriverRepository extends CoreRepository
{

    /**
     * @param bool $withTrashed
     *
     * @return Application|\Illuminate\Database\Eloquent\Model|mixed
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
