<?php

namespace App\Traits\Contractor\Controller\Transport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Трейлер для работы с прицепами.
 */
trait TrailerControllerTrait
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

        $trailer = $this->service->create($validated['trailer']);

        return $this->successRedirect(
            'create',
            ['number' => $trailer->state_number]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest $request
     * @param Model       $trailer
     *
     * @return RedirectResponse
     */
    public function traitUpdate($request, $trailer): RedirectResponse
    {
        $validated = $request->validated();

        $this->service->update($trailer, $validated['trailers']);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $trailer
     *
     * @return RedirectResponse
     */
    public function traitDestroy($trailer): RedirectResponse
    {
        $this->service->delete($trailer);

        return $this->successRedirect(
            'delete',
            ['number' => $trailer->state_number]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Model $trailer
     *
     * @return RedirectResponse
     */
    public function traitRestore($trailer): RedirectResponse
    {
        $this->service->restore($trailer);

        return $this->successRedirect(
            'restore',
            ['number' => $trailer->state_number]
        );
    }
}