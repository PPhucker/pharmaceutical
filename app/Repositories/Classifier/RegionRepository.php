<?php

namespace App\Repositories\Classifier;

use App\Models\Classifier\Region;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий регионов.
 */
class RegionRepository extends CrudRepository
{
    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return $this->clone()->orderBy('name')
            ->orderBy('zone')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return Region
     */
    public function create(array $validated): Region
    {
        return $this->model
            ->create(
                [
                    'name' => $validated['name'],
                    'zone' => $validated['zone'],
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
        foreach ($validated as $validatedRegion) {
            $model->findOrFail($validatedRegion['id'])
                ->fill(
                    [
                        'name' => $validatedRegion['name'],
                        'zone' => $validatedRegion['zone'],
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
        return Region::class;
    }
}
