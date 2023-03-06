<?php

namespace App\Http\Controllers\Classifiers;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\LegalForm\StoreLegalFormRequest;
use App\Http\Requests\Classifiers\LegalForm\UpdateLegalFormRequest;
use App\Models\Classifiers\LegalForm;
use App\Repositories\Classifiers\LegalFormRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LegalFormController extends CoreController
{
    protected function getRepository()
    {
        return LegalFormRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $legalForms = $this->repository->getAll();

        return view(
            'classifiers.legal-forms.index',
            compact('legalForms')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLegalFormRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreLegalFormRequest $request)
    {
        $validated = $request->validated()['legal_form'];

        LegalForm::create(
            [
                'abbreviation' => $validated['abbreviation'],
                'decoding' => $validated['decoding'],
            ]
        );

        return back()
            ->with(
                'store.success',
                __('classifiers.legal_forms.actions.create.success'),
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLegalFormRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateLegalFormRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['legal_forms'] as $item) {
            $legalForm = LegalForm::find($item['original_abbreviation']);

            $legalForm->fill(
                [
                    'abbreviation' => $item['abbreviation'],
                    'decoding' => $item['decoding'],
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'update.success',
                __('classifiers.legal_forms.actions.update.success')
            );
    }

    protected function getPolicy()
    {
        // TODO: Implement getPolicy() method.
    }
}
