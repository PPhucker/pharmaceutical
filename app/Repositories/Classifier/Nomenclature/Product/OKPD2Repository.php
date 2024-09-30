<?php

namespace App\Repositories\Classifier\Nomenclature\Product;

use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий классификатора ОКПД2.
 */
class OKPD2Repository extends CrudRepository
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
     * @return OKPD2
     */
    public function create(array $validated): OKPD2
    {
        return $this->model
            ->create(
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
        foreach ($validated as $okpd2) {
            $this->model->findOrFail($okpd2['original_code'])
                ->fill(
                    [
                        'code' => $okpd2['code'],
                        'name' => $okpd2['name'],
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
        return OKPD2::class;
    }
}
