<?php

namespace App\Repositories\Classifier\Nomenclature\Material;

use App\Models\Classifier\Nomenclature\Material\TypeOfMaterial;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий типа комплектующего.
 */
class TypeOfMaterialRepository extends CrudRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('name')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return TypeOfMaterial
     */
    public function create(array $validated): TypeOfMaterial
    {
        return $this->model->create(
            ['name' => $validated['name'],]
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
            $this->model->findOrFail((int)$validatedType['id'])
                ->fill(
                    ['name' => $validatedType['name'],]
                )
                ->save();
        }
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return TypeOfMaterial::class;
    }
}
