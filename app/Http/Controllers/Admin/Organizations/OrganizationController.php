<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organizations\StoreOrganizationRequest;
use App\Http\Requests\Admin\Organizations\UpdateOrganizationRequest;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\Staff;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Classifiers\BankRepository;
use App\Repositories\Classifiers\LegalFormRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrganizationController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Organization::class, 'organization');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return OrganizationRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $organizations = $this->repository->getAll();

        return view(
            'admin.organizations.index',
            compact('organizations')
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
            'admin.organizations.create',
            compact('legalForms')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Organization $organization
     *
     * @return JsonResponse
     */
    public function show(Organization $organization)
    {
        return new JsonResponse(
            ['organization' => $this->repository->getForEdit($organization->id)],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganizationRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreOrganizationRequest $request)
    {
        $validated = $request->validated();

        $organization = Organization::create(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts']
            ]
        );

        $key = 'contractors.organizations.actions.create.success';

        return redirect()
            ->route(
                'organizations.edit',
                ['organization' => $organization->id]
            )
            ->with(
                'success',
                __($key, ['name' => "$organization->legal_form_type $organization->name"])
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organization $organization
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Organization $organization)
    {
        $organization = $this->repository->getForEdit($organization->id);
        $legalForms = (new LegalFormRepository())->getAll();
        $banks = (new BankRepository())->getAll();
        $employees = Staff::STAFF;

        return view(
            'admin.organizations.edit',
            compact(
                'organization',
                'legalForms',
                'banks',
                'employees'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganizationRequest $request
     * @param Organization              $organization
     *
     * @return RedirectResponse
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $validated = $request->validated();

        $organization->fill(
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts']
            ]
        )
            ->save();

        $key = 'contractors.organizations.actions.update.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$organization->legal_form_type $organization->name"])
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Organization $organization
     *
     * @return RedirectResponse
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        $key = 'contractors.organizations.actions.destroy.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$organization->legal_form_type $organization->name"])
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Organization $organization
     *
     * @return RedirectResponse
     */
    public function restore(Organization $organization)
    {
        $organization->restore();

        $key = 'contractors.organizations.actions.restore.success';

        return back()
            ->with(
                'success',
                __($key, ['name' => "$organization->legal_form_type $organization->name"])
            );
    }
}
