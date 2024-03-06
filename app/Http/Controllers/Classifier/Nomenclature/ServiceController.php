<?php

namespace App\Http\Controllers\Classifier\Nomenclature;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Service\StoreServiceRequest;
use App\Http\Requests\Classifier\Nomenclature\Service\UpdateServiceRequest;
use App\Models\Classifier\Nomenclature\Service;
use App\Services\Classifier\Nomenclature\ServiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер классификатора услуг.
 */
class ServiceController extends CoreController
{
    /**
     * @var ServiceService
     */
    private $service;

    /**
     * @param ServiceService $service
     */
    public function __construct(ServiceService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Service::class, 'service');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.services.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreServiceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['service']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateServiceRequest $request
     * @param Service              $service
     *
     * @return RedirectResponse
     */
    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $this->service->update(
            $service,
            $request->validated()['services']
        );

        return $this->successRedirect();
    }

    /**
     * @param Service $service
     *
     * @return RedirectResponse
     */
    public function destroy(Service $service): RedirectResponse
    {
        $this->service->delete($service);

        return $this->successRedirect();
    }

    /**
     * @param Service $service
     *
     * @return RedirectResponse
     */
    public function restore(Service $service): RedirectResponse
    {
        $this->service->restore($service);

        return $this->successRedirect();
    }
}
