<?php

namespace App\Repositories\Contractors\Address;

use App\Models\Contractors\PlaceOfBusiness;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий места осуществления детельности контрагента.
 */
class PlaceOfBusinessRepository extends CrudRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $places = $this->clone();

        if ($withTrashed) {
            $places->withTrashed();
        }

        return $places
            ->orderBy('registered')
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return PlaceOfBusiness
     */
    public function create(array $validated): PlaceOfBusiness
    {
        return PlaceOfBusiness::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'identifier' => $validated['identifier'],
                'registered' => isset($validated['registered']) ? 1 : 0,
                'index' => $validated['index'],
                'address' => $validated['address']
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
        foreach ($validated['places_of_business'] as $validatedPlace) {
            $placeOfBusinessId = (int)$validatedPlace['id'];
            PlaceOfBusiness::withTrashed()
                ->find($placeOfBusinessId)
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'identifier' => $validatedPlace['identifier'],
                        'registered' => (int)$validated['registered'] === $placeOfBusinessId,
                        'index' => $validatedPlace['index'],
                        'region_id' => $validatedPlace['region_id'] ?? null,
                        'address' => $validatedPlace['address'],
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
        return PlaceOfBusiness::class;
    }
}
