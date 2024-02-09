<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct\StoreInternationalNameOfEndProductRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct\UpdateInternationalNameOfEndProductRequest;
use App\Models\Classifier\Nomenclature\Products\InternationalNameOfEndProduct;
use App\Repositories\Classifiers\Nomenclature\Products\InternationalNameOfEndProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class InternationalNameOfEndProductController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(
            InternationalNameOfEndProduct::class,
            'international_name'
        );
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return InternationalNameOfEndProductRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $internationalNamesOfEndProducts = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.international_names_of_end_products.index',
            compact('internationalNamesOfEndProducts')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInternationalNameOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreInternationalNameOfEndProductRequest $request)
    {
        $validated = $request->validated()['international_name_of_end_product'];

        $internationalNameOfEndProduct = InternationalNameOfEndProduct::create(
            [
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.international_names_of_end_products.actions.create.success',
                    ['name' => $internationalNameOfEndProduct->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInternationalNameOfEndProductRequest $request
     * @param InternationalNameOfEndProduct              $international_name
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateInternationalNameOfEndProductRequest $request,
        InternationalNameOfEndProduct $international_name
    ) {
        $validated = $request->validated();

        foreach ($validated['international_names_of_end_products'] as $internationlName) {
            InternationalNameOfEndProduct::find((int)$internationlName['id'])
                ->fill(
                    [
                        'name' => $internationlName['name'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                'classifiers.nomenclature.products.international_names_of_end_products.actions.update.success'
            );
    }
}
