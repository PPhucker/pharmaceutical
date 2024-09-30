<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProductRepository extends CrudRepository
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
     * @return InternationalNameOfEndProduct
     */
    public function create(array $validated): InternationalNameOfEndProduct
    {
        return $this->model->create(
            [
                'name' => $validated['name']
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
        foreach ($validated as $validatedInternationalName) {
            $this->model->findOrFail($validatedInternationalName['id'])
                ->fill(
                    [
                        'name' => $validatedInternationalName['name']
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
        return InternationalNameOfEndProduct::class;
    }
}
