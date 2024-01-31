<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organization\StoreOrganizationRequest;
use App\Http\Requests\Admin\Organization\UpdateOrganizationRequest;
use App\Models\Admin\Organization\Organization;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentRepository;
use App\Services\Admin\Organization\OrganizationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер организации.
 */
class OrganizationController extends CoreController
{
    /**
     * @var string
     */
    protected $prefixViewKey = 'admin.organizations.';

    /**
     * @var string
     */
    protected $prefixLocalKey = 'contractors.organizations';

    /**
     * @var OrganizationService
     */
    private $service;

    /**
     * @param OrganizationService $service
     */
    public function __construct(OrganizationService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Organization::class, 'organization');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            $this->prefixViewKey . 'index',
            $this->service->getIndexData()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Organization $organization
     *
     * @return JsonResponse
     */
    public function show(Organization $organization): JsonResponse
    {
        $invoiceLastNumber = (new InvoiceForPaymentRepository())
            ->getLastNumber($organization->id);

        return new JsonResponse(
            [
                'organization' => $this->repository->getById($organization->id),
                'number' => $invoiceLastNumber
            ],
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
    public function store(StoreOrganizationRequest $request): RedirectResponse
    {
        $organization = $this->service->create($request->validated());

        return $this->successRedirect(
            'create',
            ['name' => $organization->full_name],
            'organizations.edit',
            ['organization' => $organization->id]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view(
            $this->prefixViewKey . 'create',
            $this->service->getCreateData()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organization $organization
     *
     * @return View
     */
    public function edit(Organization $organization): View
    {
        return view(
            $this->prefixViewKey . 'edit',
            $this->service->getEditData($organization)
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
    public function update(UpdateOrganizationRequest $request, Organization $organization): RedirectResponse
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
    public function destroy(Organization $organization): RedirectResponse
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
    public function restore(Organization $organization): RedirectResponse
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
