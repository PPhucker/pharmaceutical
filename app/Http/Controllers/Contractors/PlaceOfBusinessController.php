<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\PlacesOfBusiness\StorePlaceOfBusinessRequest;
use App\Http\Requests\Contractors\PlacesOfBusiness\UpdatePlaceOfBusinessRequest;
use App\Models\Contractors\PlaceOfBusiness;
use App\Repositories\Contractors\PlaceOfBusinessRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер мест осуществления деятельности контрагнетов.
 */
class PlaceOfBusinessController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlaceOfBusinessRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePlaceOfBusinessRequest $request): RedirectResponse
    {
        $validated = $request->validated()['place_of_business'];

        $placeOfBusiness = PlaceOfBusiness::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'identifier' => $validated['identifier'],
                'registered' => isset($validated['registered']) ? 1 : 0,
                'index' => $validated['index'],
                'address' => $validated['address']
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.places_of_business.actions.create.success',
                    ['name' => $placeOfBusiness->address]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlaceOfBusinessRequest $request
     * @param PlaceOfBusiness|null         $placesOfBusiness
     *
     * @return RedirectResponse
     */
    public function update(
        UpdatePlaceOfBusinessRequest $request,
        PlaceOfBusiness $placesOfBusiness = null
    ): RedirectResponse {
        $validated = $request->validated();

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

        return back()
            ->with(
                'success',
                __('contractors.places_of_business.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlaceOfBusiness $places_of_business
     *
     * @return RedirectResponse
     */
    public function destroy(PlaceOfBusiness $places_of_business): RedirectResponse
    {
        $places_of_business->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.places_of_business.actions.destroy.success',
                    ['name' => $places_of_business->address]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param PlaceOfBusiness $places_of_business
     *
     * @return RedirectResponse
     */
    public function restore(PlaceOfBusiness $places_of_business): RedirectResponse
    {
        $places_of_business->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.places_of_business.actions.restore.success',
                    ['name' => $places_of_business->address]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(PlaceOfBusiness::class, 'places_of_business');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return PlaceOfBusinessRepository::class;
    }
}
