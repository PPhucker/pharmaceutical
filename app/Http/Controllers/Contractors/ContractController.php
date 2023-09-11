<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Contracts\StoreContractRequest;
use App\Http\Requests\Contractors\Contracts\UpdateContractRequest;
use App\Models\Contractors\Contract;
use App\Repositories\Contractors\ContractRepository;
use Auth;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер довогора с контрагентом.
 */
class ContractController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContractRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreContractRequest $request): RedirectResponse
    {
        $validated = $request->validated()['contract'];

        $userId = Auth::user()->id;

        Contract::create(
            [
                'created_by_id' => $userId,
                'updated_by_id' => $userId,
                'contractor_id' => $validated['contractor_id'],
                'organization_id' => $validated['organization_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
                'comment' => $validated['comment'],
                'is_valid' => isset($validated['is_valid']) ? 1 : 0,
            ]
        );

        return back()
            ->with(
                'success',
                __('contractors.contracts.actions.create.success')
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContractRequest $request
     * @param Contract|null         $contract
     *
     * @return RedirectResponse
     */
    public function update(UpdateContractRequest $request, Contract $contract = null): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated['contracts'] as $validatedContract) {
            Contract::withTrashed()->find((int)$validatedContract['id'])
                ->fill(
                    [
                        'updated_by_id' => Auth::user()->id,
                        'organization_id' => $validatedContract['organization_id'],
                        'number' => $validatedContract['number'],
                        'comment' => $validatedContract['comment'],
                        'is_valid' => isset($validatedContract['is_valid']) ? 1 : 0,
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.contracts.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contract $contract
     *
     * @return RedirectResponse
     */
    public function destroy(Contract $contract): RedirectResponse
    {
        $contract->delete();

        return back()
            ->with(
                'success',
                __('contractors.contracts.actions.delete.success')
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Contract $contract
     *
     * @return RedirectResponse
     */
    public function restore(Contract $contract): RedirectResponse
    {
        $contract->restore();

        return back()
            ->with(
                'success',
                __('contractors.contracts.actions.delete.success')
            );
    }

    /**
     * @inheritDoc
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Contract::class, 'contract');
    }

    /**
     * @inheritDoc
     */
    protected function getRepository(): string
    {
        return ContractRepository::class;
    }
}
