<?php

namespace App\Traits\Contractor\Controller\Transport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт для работы с водителями.
 */
trait DriverControllerTrait
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
        $validated = $request->validated();

        $driver = $this->service->create($validated['driver']);

        return $this->successRedirect(
            'create',
            ['name' => $driver->name]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest $request
     * @param Model       $driver
     *
     * @return RedirectResponse
     */
    public function traitUpdate($request, $driver): RedirectResponse
    {
        $validated = $request->validated();

        $this->service->update($driver, $validated['drivers']);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $driver
     *
     * @return RedirectResponse
     */
    public function traitDestroy($driver): RedirectResponse
    {
        $this->service->delete($driver);

        return $this->successRedirect(
            'delete',
            ['name' => $driver->name]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Model $driver
     *
     * @return RedirectResponse
     */
    public function traitRestore($driver): RedirectResponse
    {
        $this->service->restore($driver);

        return $this->successRedirect(
            'restore',
            ['name' => $driver->name]
        );
    }
}
