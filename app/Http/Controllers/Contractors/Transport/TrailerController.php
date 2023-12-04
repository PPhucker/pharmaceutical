<?php

namespace App\Http\Controllers\Contractors\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Transport\Trailers\StoreTrailerRequest;
use App\Http\Requests\Contractors\Transport\Trailers\UpdateTrailerRequest;
use App\Models\Contractors\Transport\Trailer;
use App\Services\Contractor\Transport\TrailerService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер прицепа контрагента.
 */
class TrailerController extends CoreController
{
    protected $prefixLocalKey = 'contractors.trailers';

    /**
     * @var TrailerService
     */
    private $service;

    /**
     * @param TrailerService $service
     */
    public function __construct(TrailerService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Trailer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTrailerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTrailerRequest $request): RedirectResponse
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
     * @param UpdateTrailerRequest $request
     * @param Trailer              $trailer
     *
     * @return RedirectResponse
     */
    public function update(UpdateTrailerRequest $request, Trailer $trailer): RedirectResponse
    {
        $validated = $request->validated();

        $this->service->update($trailer, $validated['trailers']);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function destroy(Trailer $trailer): RedirectResponse
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
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function restore(Trailer $trailer): RedirectResponse
    {
        $this->service->restore($trailer);

        return $this->successRedirect(
            'restore',
            ['number' => $trailer->state_number]
        );
    }
}
