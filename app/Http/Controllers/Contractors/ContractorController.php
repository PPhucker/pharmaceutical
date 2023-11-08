<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\StoreContractorRequest;
use App\Http\Requests\Contractors\UpdateContractorRequest;
use App\Models\Contractors\Contractor;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Classifiers\BankRepository;
use App\Repositories\Classifiers\LegalFormRepository;
use App\Repositories\Classifiers\RegionRepository;
use App\Repositories\Contractors\ContractorRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Контроллер контрагента.
 */
class ContractorController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $contractors = $this->repository->getAll();
        $organizations = (new OrganizationRepository())->getAll();

        return view(
            'contractors.index',
            compact('contractors', 'organizations')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContractorRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreContractorRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $contractor = Contractor::create(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts'],
                'comment' => $validated['comment'],
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
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(): View
    {
        $legalForms = (new LegalFormRepository())->getAll();

        return view(
            'contractors.create',
            compact('legalForms')
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
    public function edit(Contractor $contractor): View
    {
        $contractor = $this->repository->getById($contractor->id);

        $legalForms = (new LegalFormRepository())->getAll();
        $banks = (new BankRepository())->getAll();
        $organizations = (new OrganizationRepository())->getAll();
        $regions = (new RegionRepository())->getAll();

        return view(
            'contractors.edit',
            compact(
                'contractor',
                'legalForms',
                'banks',
                'organizations',
                'regions',
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
    public function update(UpdateContractorRequest $request, Contractor $contractor): RedirectResponse
    {
        $validated = $request->validated();

        $contractor->fill(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts'],
                'comment' => $validated['comment'],
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
    public function destroy(Contractor $contractor): RedirectResponse
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
    public function restore(Contractor $contractor): RedirectResponse
    {
        $contractor->restore();

        $key = 'contractors.organizations.actions.restore.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$contractor->legal_form_type $contractor->name"])
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Contractor::class, 'contractor');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return ContractorRepository::class;
    }
}
