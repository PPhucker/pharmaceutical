<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\StoreContractorRequest;
use App\Http\Requests\Contractors\UpdateContractorRequest;
use App\Models\Contractors\Contractor;
use App\Repositories\Classifiers\BankRepository;
use App\Repositories\Classifiers\LegalFormRepository;
use App\Repositories\Contractors\ContractorRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ContractorController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Contractor::class, 'contractor');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return ContractorRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $contractors = $this->repository->getAll();

        return view(
            'contractors.index',
            compact('contractors')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create()
    {
        $legalForms = (new LegalFormRepository())->getAll();

        return view(
            'contractors.create',
            compact('legalForms')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContractorRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreContractorRequest $request)
    {
        $validated = $request->validated();

        $contractor = Contractor::create(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'contacts' => $validated['contacts']
            ]
        );

        $key = 'contractors.actions.create.success';

        return redirect()
            ->route(
                'contractors.edit',
                ['contractor' => $contractor->id]
            )
            ->with(
                'success',
                __($key, ['name' => "$contractor->legal_form_type $contractor->name"])
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contractor $contractor
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Contractor $contractor)
    {
        $contractor = $this->repository->getForEdit($contractor->id);
        $legalForms = (new LegalFormRepository())->getAll();
        $banks = (new BankRepository())->getAll();

        return view(
            'contractors.edit',
            compact(
                'contractor',
                'legalForms',
                'banks'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContractorRequest $request
     * @param Contractor              $contractor
     *
     * @return RedirectResponse
     */
    public function update(UpdateContractorRequest $request, Contractor $contractor)
    {
        $validated = $request->validated();

        $contractor->fill(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'contacts' => $validated['contacts']
            ]
        )
            ->save();

        $key = 'contractors.actions.update.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$contractor->legal_form_type $contractor->name"])
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contractor $contractor
     *
     * @return RedirectResponse
     */
    public function destroy(Contractor $contractor)
    {
        $contractor->delete();

        $key = 'contractors.actions.destroy.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$contractor->legal_form_type $contractor->name"])
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Contractor $contractor
     *
     * @return RedirectResponse
     */
    public function restore(Contractor $contractor)
    {
        $contractor->restore();

        $key = 'contractors.organizations.actions.restore.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$contractor->legal_form_type $contractor->name"])
            );
    }
}
