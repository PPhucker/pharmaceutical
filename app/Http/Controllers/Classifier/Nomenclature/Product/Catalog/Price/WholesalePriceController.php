<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product\Catalog\Price;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price\StoreWholesalePriceRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Price\UpdateWholesalePriceRequest;
use App\Models\Classifier\Nomenclature\Product\Catalog\Price\WholesalePrice;
use App\Services\Classifier\Nomenclature\Product\Catalog\Price\WholesalePriceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер оптовой цены готовой продукции.
 */
class WholesalePriceController extends CoreController
{
    private const VIEW_PATH = 'classifiers.nomenclature.products.product-catalog.prices';
    /**
     * @var WholesalePriceService
     */
    private $service;

    /**
     * @param WholesalePriceService $service
     */
    public function __construct(WholesalePriceService $service)
    {
        $this->service = $service;

        $this->authorizeResource(WholesalePrice::class, 'wholesale_price');
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
     * @param StoreWholesalePriceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreWholesalePriceRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['wholesale_price']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateWholesalePriceRequest $request
     * @param WholesalePrice              $wholesalePrice
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateWholesalePriceRequest $request,
        WholesalePrice $wholesalePrice
    ): RedirectResponse {
        $this->service->update(
            $wholesalePrice,
            $request->validated()['wholesale_prices']
        );

        return $this->successRedirect();
    }

    /**
     * @param WholesalePrice $wholesalePrice
     *
     * @return RedirectResponse
     */
    public function destroy(WholesalePrice $wholesalePrice): RedirectResponse
    {
        $this->service->delete($wholesalePrice);

        return $this->successRedirect();
    }

    /**
     * @param WholesalePrice $wholesalePrice
     *
     * @return RedirectResponse
     */
    public function restore(WholesalePrice $wholesalePrice): RedirectResponse
    {
        $this->service->restore($wholesalePrice);

        return $this->successRedirect();
    }
}
