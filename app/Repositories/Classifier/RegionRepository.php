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

    protected function getModelClass(): string
    {
        return Region::class;
    }

    public function create(array $validated)
    {
        // TODO: Implement create() method.
    }

    public function update($model, array $validated)
    {
        // TODO: Implement update() method.
    }
}
