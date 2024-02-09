<?php

namespace App\Repositories\Contractor\Address;

use App\Repositories\CrudRepository;
use App\Models\Classifier\Region;
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
