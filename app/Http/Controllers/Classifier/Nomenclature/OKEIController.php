<?php

namespace App\Http\Controllers\Classifier\Nomenclature;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Nomenclature\Okei\StoreOKEIRequest;
use App\Http\Requests\Classifiers\Nomenclature\Okei\UpdateOKEIRequest;
use App\Models\Classifier\Nomenclature\OKEI;
use App\Repositories\Classifiers\Nomenclature\OKEIRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OKEIController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(OKEI::class, 'okei');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return OKEIRepository::class;
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

        $okei = OKEI::create(
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
     * @param OKEI|null         $okei
     *
     * @return RedirectResponse
     */
    public function update(UpdateOKEIRequest $request, OKEI $okei = null)
    {
        $validated = $request->validated();

        foreach ($validated['okei'] as $item) {
            OKEI::find($item['original_code'])
                ->fill(
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
