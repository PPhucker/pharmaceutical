<?php

namespace App\Http\Controllers\Contractor\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\Transport\Trailer\StoreTrailerRequest;
use App\Http\Requests\Contractor\Transport\Trailer\UpdateTrailerRequest;
use App\Models\Contractor\Transport\Trailer;
use App\Services\Contractor\Transport\TrailerService;
use App\Traits\Contractor\Controller\Transport\TrailerControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер прицепа контрагента.
 */
class TrailerController extends CoreController
{
    use TrailerControllerTrait;

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
     * @param StoreTrailerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTrailerRequest $request): RedirectResponse
    {
        return $this->traitStore($request);
    }

    /**
     * @param UpdateTrailerRequest $request
     * @param Trailer              $trailer
     *
     * @return RedirectResponse
     */
    public function update(UpdateTrailerRequest $request, Trailer $trailer): RedirectResponse
    {
        return $this->traitUpdate($request, $trailer);
    }

    /**
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function destroy(Trailer $trailer): RedirectResponse
    {
        return $this->traitDestroy($trailer);
    }

    /**
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function restore(Trailer $trailer): RedirectResponse
    {
        return $this->traitRestore($trailer);
    }
}
