<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\EndProduct\StoreEndProductRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\EndProduct\UpdateEndProductRequest;
use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Services\Classifier\Nomenclature\Product\EndProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер конечного продукта.
 */
class EndProductController extends CoreController
{
    /**
     * @var EndProductService
     */
    private $service;

    /**
     * @param EndProductService $service
     */
    public function __construct(EndProductService $service)
    {
        $this->service = $service;
        $this->authorizeResource(EndProduct::class, 'end_product');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.end-products.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreEndProductRequest $request): RedirectResponse
    {
        $createdEndProduct = $this->service->create(
            $request->validated()
        );

        return $this->successRedirect(
            'end_products.edit',
            ['end_product' => $createdEndProduct->id]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view(
            $this->prefixView . 'create',
            $this->service->getCreateData()
        );
    }

    /**
     * @param EndProduct $endProduct
     *
     * @return View
     */
    public function edit(EndProduct $endProduct): View
    {
        return view(
            'classifiers.nomenclature.products.end-products.edit',
            $this->service->getEditData($endProduct)
        );
    }

    /**
     * @param UpdateEndProductRequest $request
     * @param EndProduct              $endProduct
     *
     * @return RedirectResponse
     */
    public function update(UpdateEndProductRequest $request, EndProduct $endProduct): RedirectResponse
    {
        $this->service->update(
            $endProduct,
            $request->validated()
        );

        return $this->successRedirect();
    }

    /**
     * @param EndProduct $endProduct
     *
     * @return RedirectResponse
     */
    public function destroy(EndProduct $endProduct): RedirectResponse
    {
        $this->service->delete($endProduct);

        return $this->successRedirect();
    }

    /**
     * @param EndProduct $endProduct
     *
     * @return RedirectResponse
     */
    public function restore(EndProduct $endProduct): RedirectResponse
    {
        $this->service->restore($endProduct);

        return $this->successRedirect();
    }
}
