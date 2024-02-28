<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product\Type;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfEndProduct\StoreTypeOfEndProductRequest;
use App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfEndProduct\UpdateTypeOfEndProductRequest;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;
use App\Services\Classifier\Nomenclature\Product\Type\TypeOfEndProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер типа готовой продукции.
 */
class TypeOfEndProductController extends CoreController
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.types_of_end_products';

    /**
     * @var TypeOfEndProductService
     */
    private $service;

    /**
     * @param TypeOfEndProductService $service
     */
    public function __construct(TypeOfEndProductService $service)
    {
        $this->service = $service;
        $this->authorizeResource(TypeOfEndProduct::class, 'type_of_end_product');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.types-of-end-products.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreTypeOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfEndProductRequest $request): RedirectResponse
    {
        $typeOfEndProduct = $this->service->create(
            $request->validated()['type_of_end_product']
        );

        return $this->successRedirect(
            'create',
            ['name' => $typeOfEndProduct->name]
        );
    }

    /**
     * @param UpdateTypeOfEndProductRequest $request
     * @param TypeOfEndProduct              $typeOfEndProduct
     *
     * @return RedirectResponse
     */
    public function update(UpdateTypeOfEndProductRequest $request, TypeOfEndProduct $typeOfEndProduct): RedirectResponse
    {
        $this->service->update(
            $typeOfEndProduct,
            $request->validated()['types_of_end_products']
        );

        return $this->successRedirect('update');
    }

}
