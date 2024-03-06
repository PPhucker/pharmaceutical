<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct\StoreRegistrationNumberOfEndProductRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct\UpdateRegistrationNumberOfEndProductRequest;
use App\Models\Classifier\Nomenclature\Product\RegistrationNumberOfEndProduct;
use App\Services\Classifier\Nomenclature\Product\RegistrationNumberOfEndProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер регистрационных номеров готовой продукции.
 */
class RegistrationNumberOfEndProductController extends CoreController
{
    /**
     * @var RegistrationNumberOfEndProductService
     */
    private $service;

    /**
     * @param RegistrationNumberOfEndProductService $service
     */
    public function __construct(RegistrationNumberOfEndProductService $service)
    {
        $this->service = $service;
        $this->authorizeResource(RegistrationNumberOfEndProduct::class, 'registration_number');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.registration-numbers.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreRegistrationNumberOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRegistrationNumberOfEndProductRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['registration_number']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateRegistrationNumberOfEndProductRequest $request
     * @param RegistrationNumberOfEndProduct              $registrationNumber
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateRegistrationNumberOfEndProductRequest $request,
        RegistrationNumberOfEndProduct $registrationNumber
    ): RedirectResponse {
        $this->service->update(
            $registrationNumber,
            $request->validated()['registration_numbers']
        );

        return $this->successRedirect();
    }

}
