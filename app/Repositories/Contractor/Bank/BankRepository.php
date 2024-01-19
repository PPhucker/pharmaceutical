<?php

namespace App\Repositories\Contractor\Bank;

use App\Models\Classifiers\Bank;
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
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Bank::class;
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
