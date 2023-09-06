<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\PlacesOfBusiness\StorePlaceOfBusinessRequest;
use App\Http\Requests\Contractors\PlacesOfBusiness\UpdatePlaceOfBusinessRequest;
use App\Models\Contractors\PlaceOfBusiness;
use App\Repositories\Contractors\PlaceOfBusinessRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PlaceOfBusinessController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(PlaceOfBusiness::class, 'places_of_business');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return PlaceOfBusinessRepository::class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlaceOfBusinessRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePlaceOfBusinessRequest $request)
    {
        $validated = $request->validated()['place_of_business'];

        $registered = isset($validated['registered']) ? 1 : 0;

        $placeOfBusiness = PlaceOfBusiness::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'identifier' => $validated['identifier'],
                'registered' => $registered,
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
     * @param PlaceOfBusiness|null         $places_of_business
     *
     * @return RedirectResponse
     */
    public function update(
        UpdatePlaceOfBusinessRequest $request,
        PlaceOfBusiness $places_of_business = null
    ) {
        $validated = $request->validated();

        foreach ($validated['places_of_business'] as $item) {
            $placeOfBusiness = PlaceOfBusiness::withTrashed()->find((int)$item['id']);

            $registered = (int)$validated['registered'] === $placeOfBusiness->id;

            $placeOfBusiness->fill(
                [
                    'user_id' => Auth::user()->id,
                    'identifier' => $item['identifier'],
                    'registered' => $registered,
                    'index' => $item['index'],
                    'address' => $item['address']
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
    public function destroy(PlaceOfBusiness $places_of_business)
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
    public function restore(PlaceOfBusiness $places_of_business)
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
}
