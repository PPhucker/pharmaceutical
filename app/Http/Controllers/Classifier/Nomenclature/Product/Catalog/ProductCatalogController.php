<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product\Catalog;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\SalesStatisticsByContracorRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\StoreProductCatalogRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Catalog\UpdateProductCatalogRequest;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Services\Classifier\Nomenclature\Product\Catalog\ProductCatalogService;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Controller\AggregationTypeControllerTrait;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Controller\MaterialControllerTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Контроллер каталога готовой продукции.
 */
class ProductCatalogController extends CoreController
{
    use AggregationTypeControllerTrait;
    use MaterialControllerTrait;

    private const VIEW_NAME_PREFIX = 'classifiers.nomenclature.products.product-catalog.';
    /**
     * @var ProductCatalogService
     */
    private $service;

    /**
     * @param ProductCatalogService $service
     */
    public function __construct(ProductCatalogService $service)
    {
        $this->service = $service;
        $this->authorizeResource(ProductCatalog::class, 'product_catalog');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            self::VIEW_NAME_PREFIX . 'index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreProductCatalogRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProductCatalogRequest $request): RedirectResponse
    {
        $catalog = $this->service->create($request->validated());

        return $this->successRedirect(
            'product_catalog.edit',
            ['product_catalog' => $catalog->id]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view(
            self::VIEW_NAME_PREFIX . 'create',
            $this->service->getCreateData()
        );
    }

    /**
     * @param ProductCatalog $productCatalog
     *
     * @return View
     */
    public function edit(ProductCatalog $productCatalog): View
    {
        return view(
            self::VIEW_NAME_PREFIX . 'edit',
            $this->service->getEditData($productCatalog)
        );
    }

    /**
     * @param UpdateProductCatalogRequest $request
     * @param ProductCatalog              $productCatalog
     *
     * @return RedirectResponse
     */
    public function update(UpdateProductCatalogRequest $request, ProductCatalog $productCatalog): RedirectResponse
    {
        $this->service->update($productCatalog, $request->validated());

        return $this->successRedirect();
    }

    /**
     * @param ProductCatalog $productCatalog
     *
     * @return RedirectResponse
     */
    public function destroy(ProductCatalog $productCatalog): RedirectResponse
    {
        $this->service->delete($productCatalog);

        return $this->successRedirect();
    }

    /**
     * @param ProductCatalog $productCatalog
     *
     * @return RedirectResponse
     */
    public function restore(ProductCatalog $productCatalog): RedirectResponse
    {
        $this->service->restore($productCatalog);

        return $this->successRedirect();
    }

    /**
     * @param SalesStatisticsByContracorRequest $request
     * @param ProductCatalog                    $productCatalog
     *
     * @return View
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function salesStatisticsByContracor(
        SalesStatisticsByContracorRequest $request,
        ProductCatalog $productCatalog
    ): View {
        return view(
            self::VIEW_NAME_PREFIX . 'statistic',
            $this->service->getSalesStatisticsByContractorData($request->validated(), $productCatalog)
        );
    }
}
