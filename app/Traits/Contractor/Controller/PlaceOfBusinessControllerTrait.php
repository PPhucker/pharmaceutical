<?php

namespace App\Traits\Contractor\Controller;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт для работы с местом осуществления деятельности.
 */
trait PlaceOfBusinessControllerTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest $request
     *
     * @return RedirectResponse
     */
    public function traitStore($request): RedirectResponse
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
     * @param FormRequest $request
     * @param Model       $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function traitUpdate($request, $placeOfBusiness): RedirectResponse
    {
        $this->service->update(
            $placeOfBusiness,
            $request->validated()
        );

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function traitDestroy($placeOfBusiness): RedirectResponse
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
     * @param Model $placeOfBusiness
     *
     * @return RedirectResponse
     */
    public function traitRestore($placeOfBusiness): RedirectResponse
    {
        $this->service->restore($placeOfBusiness);

        return $this->successRedirect(
            'restore',
            ['name' => $placeOfBusiness->address]
        );
    }
}