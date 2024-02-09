<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\StoreEndProductRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\EndProduct\UpdateEndProductRequest;
use App\Models\Classifier\Nomenclature\Products\EndProduct;
use App\Repositories\Classifiers\Nomenclature\Products\EndProductRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EndProductController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(EndProduct::class, 'end_product');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return EndProductRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $endProducts = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.end-products.index',
            compact('endProducts')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $classifiers = $this->repository->getClassifiers();

        return view(
            'classifiers.nomenclature.products.end-products.create',
            [
                'classifiers' => $classifiers
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreEndProductRequest $request)
    {
        $validated = $request->validated();

        $endProduct = EndProduct::create(
            [
                'user_id' => Auth::user()->id,
                'type_id' => (int)$validated['type_id'],
                'international_name_id' => (int)$validated['international_name_id'],
                'registration_number_id' => $validated['registration_number_id']
                    ? (int)$validated['registration_number_id']
                    : null,
                'okei_code' => $validated['okei_code'],
                'okpd2_code' => $validated['okpd2_code'],
                'short_name' => $validated['short_name'],
                'full_name' => $validated['full_name'],
                'marking' => (bool)$validated['marking'],
                'best_before_date' => (int)$validated['best_before_date'],
            ]
        );

        return redirect()
            ->route(
                'end_products.edit',
                ['end_product' => $endProduct->id]
            )
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.actions.create.success',
                    ['name' => $endProduct->full_name]
                )
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EndProduct $endProduct
     *
     * @return View
     */
    public function edit(EndProduct $endProduct)
    {
        $data = $this->repository->getForEdit($endProduct->id);

        return view(
            'classifiers.nomenclature.products.end-products.edit',
            [
                'end_product' => $data['end_product'],
                'types' => $data['types'],
                'international_names' => $data['international_names'],
                'registration_numbers' => $data['registration_numbers'],
                'okei' => $data['okei'],
                'okpd2' => $data['okpd2'],
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEndProductRequest $request
     * @param EndProduct              $endProduct
     *
     * @return RedirectResponse
     */
    public function update(UpdateEndProductRequest $request, EndProduct $endProduct)
    {
        $validated = $request->validated();

        $endProduct->fill(
            [
                'user_id' => Auth::user()->id,
                'type_id' => (int)$validated['type_id'],
                'international_name_id' => (int)$validated['international_name_id'],
                'registration_number_id' => $validated['registration_number_id']
                    ? (int)$validated['registration_number_id']
                    : null,
                'okei_code' => $validated['okei_code'],
                'okpd2_code' => $validated['okpd2_code'],
                'short_name' => $validated['short_name'],
                'full_name' => $validated['full_name'],
                'marking' => (bool)$validated['marking'],
                'best_before_date' => (int)$validated['best_before_date'],
            ]
        )
            ->save();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.actions.update.success',
                    ['name' => $endProduct->full_name]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EndProduct $endProduct
     *
     * @return RedirectResponse
     */
    public function destroy(EndProduct $endProduct)
    {
        $endProduct->delete();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.actions.delete.success',
                    ['name' => $endProduct->full_name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param EndProduct $endProduct
     *
     * @return RedirectResponse
     */
    public function restore(EndProduct $endProduct)
    {
        $endProduct->restore();

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.actions.restore.success',
                    ['name' => $endProduct->full_name]
                )
            );
    }
}
