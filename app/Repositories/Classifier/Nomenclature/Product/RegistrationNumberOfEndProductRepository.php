<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий регистрационного номера готовой продукции.
 */
class RegistrationNumberOfEndProductRepository extends CrudRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('number')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return RegistrationNumberOfEndProduct
     */
    public function create(array $validated): RegistrationNumberOfEndProduct
    {
        return $this->model->create(
            [
                'number' => $validated['number'],
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
        foreach ($validated as $validatedRegistrationNumber) {
            $this->model->findOrFail($validatedRegistrationNumber['id'])
                ->fill(
                    [
                        'number' => $validatedRegistrationNumber['number'],
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
        return RegistrationNumberOfEndProduct::class;
    }
}
