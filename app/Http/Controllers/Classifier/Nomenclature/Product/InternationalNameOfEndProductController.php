<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\InternationalNameOfEndProduct\StoreInternationalNameOfEndProductRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\InternationalNameOfEndProduct\UpdateInternationalNameOfEndProductRequest;
use App\Models\Classifier\Nomenclature\Product\InternationalNameOfEndProduct;
use App\Services\Classifier\Nomenclature\Product\InternationalNameOfEndProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер международного непатентованного названия готовой продукции.
 */
class InternationalNameOfEndProductController extends CoreController
{
    /**
     * @var InternationalNameOfEndProductService
     */
    private $service;

    /**
     * @param InternationalNameOfEndProductService $service
     */
    public function __construct(InternationalNameOfEndProductService $service)
    {
        $this->service = $service;
        $this->authorizeResource(
            InternationalNameOfEndProduct::class,
            'international_name'
        );
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.international-names-of-end-products.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreInternationalNameOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreInternationalNameOfEndProductRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['international_name_of_end_product']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateInternationalNameOfEndProductRequest $request
     * @param InternationalNameOfEndProduct              $internationalName
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateInternationalNameOfEndProductRequest $request,
        InternationalNameOfEndProduct $internationalName
    ): RedirectResponse {
        $this->service->update(
            $internationalName,
            $request->validated()['international_names_of_end_products']
        );

        return $this->successRedirect();
    }
}
