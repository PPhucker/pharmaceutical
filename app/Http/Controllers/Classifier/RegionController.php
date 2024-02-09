<?php

namespace App\Http\Controllers\Classifier;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Region\StoreRegionRequest;
use App\Http\Requests\Classifiers\Region\UpdateRegionRequest;
use App\Models\Classifier\Region;
use App\Repositories\Classifiers\RegionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер регионов РФ.
 */
class RegionController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $regions = $this->repository->getAll();

        return view(
            'classifiers.regions.index',
            compact('regions')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRegionRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRegionRequest $request): RedirectResponse
    {
        $validated = $request->validated()['region'];

        Region::create(
            [
                'name' => $validated['name'],
                'zone' => $validated['zone'],
            ]
        );

        return back()
            ->with(
                'success',
                __('classifiers.regions.actions.create.success')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRegionRequest $request
     * @param Region              $region
     *
     * @return RedirectResponse
     */
    public function update(UpdateRegionRequest $request, Region $region): RedirectResponse
    {
        $validatedRegions = $request->validated()['regions'];

        foreach ($validatedRegions as $validatedRegion) {
            Region::find($validatedRegion['id'])
                ->fill(
                    [
                        'name' => $validatedRegion['name'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.regions.actions.update.success')
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Region::class, 'region');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return RegionRepository::class;
    }
}
