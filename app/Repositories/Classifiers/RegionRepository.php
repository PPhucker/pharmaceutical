<?php

namespace App\Repositories\Classifiers;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Region as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий регионов.
 */
class RegionRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Получить все регионы.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('classifier_regions.name')
            ->orderBy('classifier_regions.zone')
            ->get();
    }
}
