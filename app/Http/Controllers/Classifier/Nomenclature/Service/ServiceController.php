<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Service;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Services\StoreServiceRequest;
use App\Http\Requests\Classifiers\Nomenclature\Services\UpdateServiceRequest;
use App\Models\Classifier\Nomenclature\Services\Service;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository;
use App\Repositories\Classifiers\Nomenclature\Services\ServiceRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $services = $this->repository->getAll();
        $okeiClassifier = (new OKEIRepository())->getAll();

        return view(
            'classifiers.nomenclature.services.index',
            compact(
                'services',
                'okeiClassifier',
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated()['service'];

        $service = Service::create(
            [
                'user_id' => Auth::user()->id,
                'name' => $validated['name'],
                'okei_code' => $validated['okei_code'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.services.actions.create.success',
                    ['name' => $service->name]
                )
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateServiceRequest $request
     * @param Service|null         $service
     *
     * @return RedirectResponse
     */
    public function update(UpdateServiceRequest $request, Service $service = null)
    {
        $validated = $request->validated();

        foreach ($validated['services'] as $validatedService) {
            Service::find((int)$validatedService['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'name' => $validatedService['name'],
                        'okei_code' => $validatedService['okei_code'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.services.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     *
     * @return RedirectResponse
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.services.actions.delete.success',
                    ['name' => $service->name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Service $service
     *
     * @return RedirectResponse
     */
    public function restore(Service $service)
    {
        $service->restore();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.services.actions.restore.success',
                    ['name' => $service->name]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Service::class, 'service');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return ServiceRepository::class;
    }
}
