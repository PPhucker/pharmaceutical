<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price\StoreProductPriceRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price\UpdateProductPriceRequest;
use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice;
use App\Services\Classifier\Nomenclature\Product\Catalog\Price\RetailPriceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер розничной цены готовой продукции.
 */
class ProductPriceController extends CoreController
{
    private const VIEW_PATH = 'classifiers.nomenclature.products.product-catalog.prices';
    /**
     * @var RetailPriceService
     */
    private $service;

    /**
     * @param RetailPriceService $service
     */
    public function __construct(RetailPriceService $service)
    {
        $this->service = $service;

        $this->authorizeResource(ProductPrice::class, 'product_price');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            self::VIEW_PATH,
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreProductPriceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProductPriceRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['product_price']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateProductPriceRequest $request
     * @param ProductPrice              $productPrice
     *
     * @return RedirectResponse
     */
    public function update(UpdateProductPriceRequest $request, ProductPrice $productPrice): RedirectResponse
    {
        $this->service->update($productPrice, $request->validated()['product_price']);

        return $this->successRedirect();
    }
}
