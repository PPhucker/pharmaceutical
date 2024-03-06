<?php

namespace App\Traits\Contractor\Controller\Transport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт для работы с автомобилями.
 */
trait CarControllerTrait
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
        $this->service->create(
            $request->validated()['car']
        );

        return $this->successRedirect();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest $request
     * @param Model       $car
     *
     * @return RedirectResponse
     */
    public function traitUpdate($request, $car): RedirectResponse
    {
        $this->service->update(
            $car,
            $request->validated()['cars']
        );

        return $this->successRedirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $car
     *
     * @return RedirectResponse
     */
    public function traitDestroy($car): RedirectResponse
    {
        $this->service->delete($car);

        return $this->successRedirect();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Model $car
     *
     * @return RedirectResponse
     */
    public function traitRestore($car): RedirectResponse
    {
        $this->service->restore($car);

        return $this->successRedirect();
    }
}
