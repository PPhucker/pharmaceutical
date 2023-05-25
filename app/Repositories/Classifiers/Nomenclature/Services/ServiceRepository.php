<?php

namespace App\Repositories\Classifiers\Nomenclature\Services;

use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Services\Service as Model;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ServiceRepository extends CoreRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(bool $withTrashed = true)
    {
        $services = $this->model->clone();

        if ($withTrashed) {
            $services->withTrashed();
        } else {
            $services->withoutTrashed();
        }
        return $services->with(
            [
                'okei:code,symbol,unit'
            ]
        )
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
