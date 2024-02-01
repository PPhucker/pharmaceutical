<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\PlaceOfBusiness\StorePlaceOfBusinessRequest;
use App\Http\Requests\Contractor\PlaceOfBusiness\UpdatePlaceOfBusinessRequest;
use App\Models\Contractor\PlaceOfBusiness;
use App\Services\Contractor\Address\PlaceOfBusinessService;
use App\Traits\Contractor\Controller\PlaceOfBusinessControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер мест осуществления деятельности контрагнетов.
 */
class PlaceOfBusinessController extends CoreController
{
    use PlaceOfBusinessControllerTrait;

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
        return $this->traitStore($request);
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
        return $this->traitUpdate($request, $placeOfBusiness);
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
        return $this->traitDestroy($placeOfBusiness);
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
        return $this->traitRestore($placeOfBusiness);
    }
}
