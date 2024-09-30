<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\StoreContractorRequest;
use App\Http\Requests\Contractor\UpdateContractorRequest;
use App\Models\Contractor\Contractor;
use App\Services\Contractor\ContractorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер контрагента.
 */
class ContractorController extends CoreController
{
    /**
     * @var ContractorService
     */
    private $service;

    /**
     * @param ContractorService $service
     */
    public function __construct(ContractorService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Contractor::class, 'contractor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contractors.index', $this->service->getIndexData());
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
        $contractor = $this->service->create($request->validated());

        return $this->successRedirect(
            'contractors.edit',
            ['contractor' => $contractor->id]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('contractors.create', $this->service->getCreateData());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contractor $contractor
     *
     * @return View
     */
    public function edit(Contractor $contractor): View
    {
        return view('contractors.edit', $this->service->getEditData($contractor));
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
        $this->service->update($contractor, $request->validated());

        return $this->successRedirect();
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
        $this->service->delete($contractor);

        return $this->successRedirect();
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
        $this->service->restore($contractor);

        return $this->successRedirect();
    }
}
