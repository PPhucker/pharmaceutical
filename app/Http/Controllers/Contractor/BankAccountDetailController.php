<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\BankAccountDetail\StoreBankAccountDetailRequest;
use App\Http\Requests\Contractor\BankAccountDetail\UpdateBankAccountDetailRequest;
use App\Models\Contractor\BankAccountDetail;
use App\Services\Contractor\Bank\AccountDetailService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер банковских реквизитов контрагента.
 */
class BankAccountDetailController extends CoreController
{
    protected $prefixLocalKey = 'contractors.bank_account_details';

    /**
     * @var AccountDetailService
     */
    private $service;

    /**
     * @param AccountDetailService $service
     */
    public function __construct(AccountDetailService $service)
    {
        $this->service = $service;
        $this->authorizeResource(BankAccountDetail::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBankAccountDetailRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBankAccountDetailRequest $request): RedirectResponse
    {
        $validated = $request->validated()['bank_account_detail'];

        $bankAccountDetail = $this->service->create($validated);

        return $this->successRedirect(
            'create',
            ['name' => $bankAccountDetail->payment_account]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankAccountDetailRequest $request
     * @param BankAccountDetail              $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateBankAccountDetailRequest $request,
        BankAccountDetail $bankAccountDetail
    ): RedirectResponse {
        $validated = $request->validated();

        $this->service->update($bankAccountDetail, $validated);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function destroy(BankAccountDetail $bankAccountDetail): RedirectResponse
    {
        $this->service->delete($bankAccountDetail);

        return $this->successRedirect(
            'delete',
            ['name' => $bankAccountDetail->payment_account]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function restore(BankAccountDetail $bankAccountDetail): RedirectResponse
    {
        $this->service->restore($bankAccountDetail);

        return $this->successRedirect(
            'restore',
            ['name' => $bankAccountDetail->payment_account]
        );
    }
}
