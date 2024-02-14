<?php

namespace App\Http\Controllers\Classifier;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\LegalForm\StoreLegalFormRequest;
use App\Http\Requests\Classifier\LegalForm\UpdateLegalFormRequest;
use App\Models\Classifier\LegalForm;
use App\Services\Classifier\LegalFormService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер организационно правовой формы.
 */
class LegalFormController extends CoreController
{
    protected $prefixLocalKey = 'classifiers.legal_forms';
    /**
     * @var LegalFormService
     */
    private $service;

    /**
     * @param LegalFormService $service
     */
    public function __construct(LegalFormService $service)
    {
        $this->service = $service;
        $this->authorizeResource(LegalForm::class, 'legal_form');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.legal-forms.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreLegalFormRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreLegalFormRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['legal_form']
        );

        return $this->successRedirect('create');
    }

    /**
     * @param UpdateLegalFormRequest $request
     * @param LegalForm              $legalForm
     *
     * @return RedirectResponse
     */
    public function update(UpdateLegalFormRequest $request, LegalForm $legalForm): RedirectResponse
    {
        $this->service->update(
            $legalForm,
            $request->validated()['legal_forms']
        );

        return $this->successRedirect('update');
    }
}
