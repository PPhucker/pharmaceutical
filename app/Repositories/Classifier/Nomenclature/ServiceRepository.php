<?php

namespace App\Repositories\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\Service;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Репозиторий услуги.
 */
class ServiceRepository extends CrudRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(bool $withTrashed = true): Collection
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
     * @param array $validated
     *
     * @return Service
     */
    public function create(array $validated): Service
    {
        return $this->model->create(
            [
                'user_id' => Auth::user()->id,
                'name' => $validated['name'],
                'okei_code' => $validated['okei_code'],
            ]
        );
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        foreach ($validated as $validatedService) {
            $this->model->findOrFail((int)$validatedService['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'name' => $validatedService['name'],
                        'okei_code' => $validatedService['okei_code'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Service::class;
    }
}
