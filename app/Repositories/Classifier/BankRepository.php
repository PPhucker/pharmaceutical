<?php

namespace App\Repositories\Classifier;

use App\Models\Classifier\Bank;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий банков.
 */
class BankRepository extends CrudRepository
{
    /**
     * @inheritdoc
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
     * @return Bank
     */
    public function create(array $validated): Bank
    {
        return $this->model->create(
            [
                'BIC' => $validated['BIC'],
                'correspondent_account' => $validated['correspondent_account'],
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
        foreach ($validated as $item) {
            $this->model->findOrFail($item['original_BIC'])
                ->fill(
                    [
                        'BIC' => $item['BIC'],
                        'correspondent_account' => $item['correspondent_account'],
                        'name' => $item['name'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Bank::class;
    }
}
