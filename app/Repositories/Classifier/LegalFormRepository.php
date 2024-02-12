<?php

namespace App\Repositories\Classifier;

use App\Models\Classifier\LegalForm;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий организационно правовых форм.
 */
class LegalFormRepository extends CrudRepository
{
    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->orderBy('abbreviation')
            ->get();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return LegalForm::class;
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
