<?php

namespace App\Http\Controllers\Contractors;

use App\Helpers\Local;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\PlacesOfBusiness\StorePlaceOfBusinessRequest;
use App\Http\Requests\Contractors\PlacesOfBusiness\UpdatePlaceOfBusinessRequest;
use App\Models\Contractors\PlaceOfBusiness;
use App\Services\Contractor\Address\PlaceOfBusinessService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер мест осуществления деятельности контрагнетов.
 */
class PlaceOfBusinessController extends CoreController
{
    protected $prefixLocalKey = 'contractors.places_of_business';
    /**
     * @var PlaceOfBusinessService
     */
    private $service;

    /**
     * @param PlaceOfBusinessService $service
     */
    public function __construct(PlaceOfBusinessService $service)
    {
        $this->service = $service;
        $this->authorizeResource(PlaceOfBusiness::class, 'place_of_business');
    }

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
        $placeObBusiness = $this->service->create($validated);

        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'create'),
                    ['name' => $placeObBusiness->address]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlaceOfBusinessRequest $request
     * @param PlaceOfBusiness              $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function update(
        UpdatePlaceOfBusinessRequest $request,
        PlaceOfBusiness $placeOfBusiness
    ): RedirectResponse {
        $this->service->update(
            $placeOfBusiness,
            $request->validated()
        );

        return back()
            ->with(
                'success',
                __(Local::getSuccessMessageKey($this->prefixLocalKey, 'update'))
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function destroy(PlaceOfBusiness $placeOfBusiness): RedirectResponse
    {
        $this->service->delete($placeOfBusiness);

        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'destroy'),
                    ['name' => $placeOfBusiness->address]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param PlaceOfBusiness $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function restore(PlaceOfBusiness $placeOfBusiness): RedirectResponse
    {
        $this->service->restore($placeOfBusiness);

        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'restore'),
                    ['name' => $placeOfBusiness->address]
                )
            );
    }
}
