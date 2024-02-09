<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct\StoreRegistrationNumberOfEndProductRequest;
use App\Http\Requests\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProduct\UpdateRegistrationNumberOfEndProductRequest;
use App\Models\Classifier\Nomenclature\Products\RegistrationNumberOfEndProduct;
use App\Repositories\Classifiers\Nomenclature\Products\RegistrationNumberOfEndProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationNumberOfEndProductController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(
            RegistrationNumberOfEndProduct::class,
            'registration_number'
        );
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return RegistrationNumberOfEndProductRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $registrationNumbers = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.registration-numbers-of-end-products.index',
            compact('registrationNumbers')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRegistrationNumberOfEndProductRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRegistrationNumberOfEndProductRequest $request)
    {
        $validated = $request->validated()['registration_number'];

        $registrationNumber = RegistrationNumberOfEndProduct::create(
            [
                'number' => $validated['number'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.registration_numbers.actions.create.success',
                    ['number' => $registrationNumber->number]
                ),
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRegistrationNumberOfEndProductRequest $request
     * @param RegistrationNumberOfEndProduct|null         $registration_number
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateRegistrationNumberOfEndProductRequest $request,
        RegistrationNumberOfEndProduct $registration_number = null
    ) {
        $validated = $request->validated();

        foreach ($validated['registration_numbers'] as $registrationNumber) {
            RegistrationNumberOfEndProduct::find((int)$registrationNumber['id'])
                ->fill(
                    [
                        'number' => $registrationNumber['number'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.registration_numbers.actions.update.success')
            );
    }
}
