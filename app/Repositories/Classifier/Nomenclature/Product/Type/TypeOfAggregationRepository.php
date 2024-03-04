<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий типа агрегации.
 */
class TypeOfAggregationRepository extends CrudRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('code')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return TypeOfAggregation
     */
    public function create(array $validated): TypeOfAggregation
    {
        return $this->model->create(
            [
                'code' => $validated['code'],
                'name' => $validated['name'],
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
        foreach ($validated as $validatedType) {
            $this->model->findOrFail($validatedType['original_code'])
                ->fill(
                    [
                        'code' => $validatedType['code'],
                        'name' => $validatedType['name'],
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
        return TypeOfAggregation::class;
    }
}
