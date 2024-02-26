<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Products\Okpd2\StoreOKPD2Request;
use App\Http\Requests\Classifiers\Nomenclature\Products\Okpd2\UpdateOKPD2Request;
use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Repositories\Classifier\Nomenclature\Product\OKPD2Repository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OKPD2Controller extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(OKPD2::class, 'okpd2');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return OKPD2Repository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $okpd2 = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.products.okpd2.index',
            compact('okpd2')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOKPD2Request $request
     *
     * @return RedirectResponse
     */
    public function store(StoreOKPD2Request $request)
    {
        $validated = $request->validated()['okpd2'];

        $okpd2 = OKPD2::create(
            [
                'code' => $validated['code'],
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.products.okpd2.actions.create.success',
                    ['code' => $okpd2->code]
                )
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOKPD2Request $request
     * @param OKPD2              $okpd2
     *
     * @return RedirectResponse
     */
    public function update(UpdateOKPD2Request $request, OKPD2 $okpd2)
    {
        $validated = $request->validated();

        foreach ($validated['okpd2'] as $classifier) {
            OKPD2::find($classifier['original_code'])
                ->fill(
                    [
                        'code' => $classifier['code'],
                        'name' => $classifier['name']
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.products.okpd2.actions.update.success')
            );
    }
}
