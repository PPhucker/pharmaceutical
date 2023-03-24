<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organizations\PlacesOfBusiness\StorePlaceOfBusinessRequest;
use App\Http\Requests\Admin\Organizations\PlacesOfBusiness\UpdatePlaceOfBusinessRequest;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Repositories\Admin\Organizations\PlaceOfBusinessRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
                'organization_id' => (int)$validated['organization_id'],
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
     *
     * @return RedirectResponse
     */
    public function update(UpdatePlaceOfBusinessRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['places_of_business'] as $item) {
            $placeOfBusiness = PlaceOfBusiness::find((int)$item['id']);

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
