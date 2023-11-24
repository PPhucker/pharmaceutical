<?php

namespace App\Http\Controllers\Contractors;

use App\Helpers\Local;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\StoreContractorRequest;
use App\Http\Requests\Contractors\UpdateContractorRequest;
use App\Models\Contractors\Contractor;
use App\Services\Contractor\ContractorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер контрагента.
 */
class ContractorController extends CoreController
{
    /**
     * @var string
     */
    protected $prefixLocalKey = 'contractors';
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
        $this->authorizeResource(Contractor::class);
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

        return redirect()
            ->route('contractors.edit', ['contractor' => $contractor->id])
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'create'),
                    ['name' => $contractor->full_name]
                )
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
        $updatedContractor = $this->service->update($contractor, $request->validated());

        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'update'),
                    ['name' => $updatedContractor->full_name]
                )
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
        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'destroy'),
                    ['name' => $this->service->delete($contractor)->full_name]
                )
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
        return back()
            ->with(
                'success',
                __(
                    Local::getSuccessMessageKey($this->prefixLocalKey, 'restore'),
                    ['name' => $this->service->restore($contractor)->full_name]
                )
            );
    }
}
