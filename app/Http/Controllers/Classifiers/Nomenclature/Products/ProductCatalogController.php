<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Products;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\StoreProductCatalogRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog\UpdateProductCatalogRequest;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use App\Repositories\Admin\Organizations\PlaceOfBusinessRepository;
use App\Repositories\Classifiers\Nomenclature\Products\EndProductRepository;
use App\Repositories\Classifiers\Nomenclature\Products\ProductCatalogRepository;
use App\Traits\Classifiers\Nomenclature\Products\AggregationTypes;
use App\Traits\Classifiers\Nomenclature\Products\Materials;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductCatalogController extends CoreController
{
    use Materials, AggregationTypes;

    /**
     * @return string
     */
    protected function getRepository()
    {
        return ProductCatalogRepository::class;
    }

    /**
     * @return void
     */
    protected function getPolicy()
    {
        $this->authorizeResource(ProductCatalog::class, 'product_catalog');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $catalog = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.product-catalog.index',
            compact('catalog')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create()
    {
        $endProducts = (new EndProductRepository())->getAll();
        $placesOfBusiness = (new PlaceOfBusinessRepository())->getAll();

        return view(
            'classifiers.nomenclature.products.product-catalog.create',
            compact('endProducts', 'placesOfBusiness')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductCatalogRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProductCatalogRequest $request)
    {
        $validated = $request->validated();

        $productCatalog = ProductCatalog::create(
            [
                'user_id' => Auth::user()->id,
                'product_id' => (int)$validated['product_id'],
                'organization_id' => PlaceOfBusiness::find((int)$validated['place_of_business_id'])
                    ->organization->id,
                'place_of_business_id' => (int)$validated['place_of_business_id'],
                'GTIN' => $validated['GTIN'],
            ]
        );

        return redirect()
            ->route(
                'product_catalog.edit',
                ['product_catalog' => $productCatalog->id]
            )
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.product_catalog.actions.create.success',
                    ['name' => $productCatalog->endProduct->full_name]
                ),
            );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCatalog $productCatalog
     *
     * @return View
     */
    public function edit(ProductCatalog $productCatalog)
    {
        $productCatalog = $this->repository->getForEdit($productCatalog->id);

        return view(
            'classifiers.nomenclature.products.product-catalog.edit',
            [
                'product' => $productCatalog['product'],
                'end_products' => $productCatalog['end_products'],
                'materials' => $productCatalog['materials'],
                'aggregation_types' => $productCatalog['aggregation_types'],
                'places_of_business' => $productCatalog['places_of_business'],
                'organizations' => $productCatalog['organizations'],
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductCatalogRequest $request
     * @param ProductCatalog              $productCatalog
     *
     * @return RedirectResponse
     */
    public function update(UpdateProductCatalogRequest $request, ProductCatalog $productCatalog)
    {
        $validated = $request->validated();

        $productCatalog->fill(
            [
                'user_id' => Auth::user()->id,
                'product_id' => (int)$validated['product_id'],
                'organization_id' => PlaceOfBusiness::find((int)$validated['place_of_business_id'])
                    ->organization->id,
                'place_of_business_id' => (int)$validated['place_of_business_id'],
                'GTIN' => $validated['GTIN'],
            ]
        )
            ->save();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.product_catalog.actions.update.success',
                    ['name' => $productCatalog->endProduct->full_name]
                ),
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCatalog $productCatalog
     *
     * @return RedirectResponse
     */
    public function destroy(ProductCatalog $productCatalog)
    {
        $productCatalog->delete();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.product_catalog.actions.delete.success',
                    ['name' => $productCatalog->endProduct->full_name]
                ),
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param ProductCatalog $productCatalog
     *
     * @return RedirectResponse
     */
    public function restore(ProductCatalog $productCatalog)
    {
        $productCatalog->restore();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.product_catalog.actions.delete.success',
                    ['name' => $productCatalog->endProduct->full_name]
                ),
            );
    }
}
