<?php

namespace App\Repositories\Admin\Organization;

use App\Models\Admin\Organization\PlaceOfBusiness;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contractor\Address\PlaceOfBusinessRepository as ContractorPlaceOfBusinessRepository;

/**
 * Репозиторий мест осуществления деятельности организации.
 */
class PlaceOfBusinessRepository extends ContractorPlaceOfBusinessRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $places = $this->clone()
            ->where('organization_id', '=', session('organization_id'));

        if ($withTrashed) {
            $places->withTrashed();
        }

        return $places
            ->with([
                'organization:id,name,legal_form_type',
            ])
            ->orderBy('registered')
            ->get();
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
            $this->model
                ->findOrFail($placeOfBusinessId)
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'identifier' => $validatedPlace['identifier'],
                        'registered' => (int)$validated['registered'] === $placeOfBusinessId,
                        'index' => $validatedPlace['index'],
                        'address' => $validatedPlace['address'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @param array $validated
     *
     * @return PlaceOfBusiness
     */
    public function create(array $validated)
    {
        return $this->model
            ->create(
                [
                    'user_id' => Auth::user()->id,
                    'organization_id' => (int)$validated['organization_id'],
                    'identifier' => $validated['identifier'],
                    'registered' => isset($validated['registered']) ? 1 : 0,
                    'index' => $validated['index'],
                    'address' => $validated['address']
                ]
            );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return PlaceOfBusiness::class;
    }
}
