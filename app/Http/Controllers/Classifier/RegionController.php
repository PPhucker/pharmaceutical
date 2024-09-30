<?php

namespace App\Http\Controllers\Classifier;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Region\StoreRegionRequest;
use App\Http\Requests\Classifier\Region\UpdateRegionRequest;
use App\Models\Classifier\Region;
use App\Services\Classifier\RegionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер регионов РФ.
 */
class RegionController extends CoreController
{
    /**
     * @var RegionService
     */
    private $service;

    /**
     * @param RegionService $service
     */
    public function __construct(RegionService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Region::class, 'region');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.regions.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreRegionRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRegionRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['region']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateRegionRequest $request
     * @param Region              $region
     *
     * @return RedirectResponse
     */
    public function update(UpdateRegionRequest $request, Region $region): RedirectResponse
    {
        $this->service->update(
            $region,
            $request->validated()['regions']
        );

        return $this->successRedirect();
    }
}
