<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\PlacesOfBusines\StorePlaceOfBusinessRequest;
use App\Http\Requests\Contractor\PlacesOfBusines\UpdatePlaceOfBusinessRequest;
use App\Models\Contractor\PlaceOfBusiness;
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
        $placeOfBusiness = $this->service->create($validated);

        return $this->successRedirect(
            'create',
            ['name' => $placeOfBusiness->address]
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

        return $this->successRedirect('update');
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

        return $this->successRedirect(
            'delete',
            ['name' => $placeOfBusiness->address]
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

        return $this->successRedirect(
            'restore',
            ['name' => $placeOfBusiness->address]
        );
    }
}
