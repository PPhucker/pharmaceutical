<?php

namespace App\Repositories\Contractor\Transport;

use App\Models\Contractor\Transport\Trailer;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий прицепа контрагента.
 */
class TrailerRepository extends CrudRepository
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $validated
     *
     * @return Trailer
     */
    public function create(array $validated): Trailer
    {
        return $this->model->create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'type' => $validated['type'],
                'state_number' => $validated['state_number'],
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
        foreach ($validated as $validatedTrailer) {
            $this->model
                ->withTrashed()
                ->findOrFail((int)$validatedTrailer['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'type' => $validatedTrailer['type'],
                        'state_number' => $validatedTrailer['state_number'],
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
        return Trailer::class;
    }
}
