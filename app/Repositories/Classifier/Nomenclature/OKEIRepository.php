<?php

namespace App\Repositories\Classifier\Nomenclature;

use App\Models\Classifier\Nomenclature\OKEI;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий ОКЕИ классификатора.
 */
class OKEIRepository extends CrudRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return OKEI::class;
    }

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
     * @return OKEI
     */
    public function create(array $validated): OKEI
    {
        return $this->model->create(
            [
                'code' => $validated['code'],
                'unit' => $validated['unit'],
                'symbol' => $validated['symbol'],
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
        foreach ($validated as $validatedOkei) {
            $this->model->findOrFail($validatedOkei['original_code'])
                ->fill(
                    [
                        'code' => $validatedOkei['code'],
                        'unit' => $validatedOkei['unit'],
                        'symbol' => $validatedOkei['symbol'],
                    ]
                )
                ->save();
        }
    }
}
