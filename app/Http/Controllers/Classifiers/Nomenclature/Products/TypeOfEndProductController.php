<?php

namespace App\Http\Controllers\Classifiers\Nomenclature\Products;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfEndProduct\StoreTypeOfEndProductRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\TypeOfEndProduct\UpdateTypeOfEndProductRequest;
use App\Models\Classifiers\Nomenclature\Products\TypeOfEndProduct;
use App\Repositories\Classifiers\Nomenclature\Products\TypeOfEndProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TypeOfEndProductController extends CoreController
{

    protected function getRepository()
    {
        return TypeOfEndProductRepository::class;
    }

    protected function getPolicy()
    {
        $this->authorizeResource(TypeOfEndProduct::class, 'types_of_end_product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $typesOfEndProducts = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.types-of-end-products.index',
            compact('typesOfEndProducts')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTypeOfEndProductRequest $request)
    {
        $validated = $request->validated()['type_of_end_product'];

        $typeOfEndProduct = TypeOfEndProduct::create(
            [
                'name' => $validated['name'],
                'color' => $validated['color']
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.types_of_end_products.actions.create.success',
                    ['name' => $typeOfEndProduct->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeOfEndProductRequest $request
     * @param TypeOfEndProduct|null         $types_of_end_product
     *
     * @return RedirectResponse
     */
    public function update(UpdateTypeOfEndProductRequest $request, TypeOfEndProduct $types_of_end_product = null)
    {
        $validated = $request->validated();

        foreach ($validated['types_of_end_products'] as $item) {
            $typeOfEndProduct = TypeOfEndProduct::find($item['id']);
            $typeOfEndProduct->fill(
                [
                    'name' => $item['name'],
                    'color' => $item['color']
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.types_of_end_products.actions.create.success')
            );
    }

}
