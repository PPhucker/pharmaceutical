<?php

namespace App\Http\Controllers\Classifier\Nomenclature;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Okei\StoreOKEIRequest;
use App\Http\Requests\Classifier\Nomenclature\Okei\UpdateOKEIRequest;
use App\Models\Classifier\Nomenclature\OKEI;
use App\Services\Classifier\Nomenclature\OKEIService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер классификатора OKEI.
 */
class OKEIController extends CoreController
{
    /**
     * @var OKEIService
     */
    private $service;

    /**
     * @param OKEIService $service
     */
    public function __construct(OKEIService $service)
    {
        $this->service = $service;
        $this->authorizeResource(OKEI::class, 'okei');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.okei.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreOKEIRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreOKEIRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateOKEIRequest $request
     * @param OKEI              $okei
     *
     * @return RedirectResponse
     */
    public function update(UpdateOKEIRequest $request, OKEI $okei): RedirectResponse
    {
        $this->service->update(
            $okei,
            $request->validated()['okei']
        );

        return $this->successRedirect();
    }
}
