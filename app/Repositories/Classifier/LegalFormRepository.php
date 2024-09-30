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
     * @param array $validated
     *
     * @return LegalForm
     */
    public function create(array $validated): LegalForm
    {
        return $this->model
            ->create(
                [
                    'abbreviation' => $validated['abbreviation'],
                    'decoding' => $validated['decoding'],
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
        foreach ($validated as $legalForm) {
            $model->findOrFail($legalForm['original_abbreviation'])
                ->fill(
                    [
                        'abbreviation' => $legalForm['abbreviation'],
                        'decoding' => $legalForm['decoding'],
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
        return LegalForm::class;
    }
}
