<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Type;

use App\Models\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий типа готовой продукции.
 */
class TypeOfEndProductRepository extends CrudRepository
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->select('*')
            ->orderBy('name')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return TypeOfEndProduct
     */
    public function create(array $validated): TypeOfEndProduct
    {
        return $this->model->create(
            [
                'name' => $validated['name'],
                'color' => $validated['color']
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
            $this->model->findOrFail((int)$validatedType['id'])
                ->fill(
                    [
                        'name' => $validatedType['name'],
                        'color' => $validatedType['color']
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
        return TypeOfEndProduct::class;
    }
}
