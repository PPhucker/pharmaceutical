<?php

namespace App\Http\Controllers\Classifiers\Nomenclature;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Okei\StoreOKEIRequest;
use App\Http\Requests\Classifiers\Nomenclature\Okei\UpdateOKEIRequest;
use App\Models\Classifiers\Nomenclature\OKEI;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository as Repository;
use App\Models\Classifiers\Nomenclature\OKEI as Model;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OKEIController extends CoreController
{
    protected function getRepository()
    {
        return Repository::class;
    }

    protected function getPolicy()
    {
        $this->authorizeResource(Model::class, 'okei');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $okei = $this->repository->getAll();

        return view(
            'classifiers.nomenclature.okei.index',
            compact('okei')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOKEIRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreOKEIRequest $request)
    {
        $validated = $request->validated()['okei'];

        $okei = Model::create(
            [
                'code' => $validated['code'],
                'unit' => $validated['unit'],
                'symbol' => $validated['symbol'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'classifiers.nomenclature.okei.actions.create.success',
                    ['name' => $okei->symbol]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOKEIRequest $request
     * @param Model|null        $okei
     *
     * @return RedirectResponse
     */
    public function update(UpdateOKEIRequest $request, OKEI $okei = null)
    {
        $validated = $request->validated();

        foreach ($validated['okei'] as $item) {
            $okeiClassifier = Model::find($item['original_code']);

            $okeiClassifier->fill(
                [
                    'code' => $item['code'],
                    'unit' => $item['unit'],
                    'symbol' => $item['symbol'],
                ]
            );
        }

        return back()
            ->with(
                'success',
                __('classifiers.nomenclature.okei.actions.update.success')
            );
    }
}
