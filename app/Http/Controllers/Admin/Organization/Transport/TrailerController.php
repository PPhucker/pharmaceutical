<?php

namespace App\Http\Controllers\Admin\Organization\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organization\Transport\Trailers\StoreTrailerRequest;
use App\Http\Requests\Admin\Organization\Transport\Trailers\UpdateTrailerRequest;
use App\Models\Admin\Organization\Transport\Trailer;
use App\Services\Admin\Organization\Trasport\TrailerService;
use App\Traits\Contractor\Controller\Transport\TrailerControllerTrait;
use Illuminate\Http\RedirectResponse;

class TrailerController extends CoreController
{
    use TrailerControllerTrait;

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
        $this->authorizeResource(Trailer::class, 'trailer');
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
