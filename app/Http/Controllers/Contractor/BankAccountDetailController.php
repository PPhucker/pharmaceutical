<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\BankAccountDetail\StoreBankAccountDetailRequest;
use App\Http\Requests\Contractor\BankAccountDetail\UpdateBankAccountDetailRequest;
use App\Models\Contractor\BankAccountDetail;
use App\Services\Contractor\Bank\AccountDetailService;
use App\Traits\Contractor\Controller\BankAccountDetailControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер банковских реквизитов контрагента.
 */
class BankAccountDetailController extends CoreController
{
    use BankAccountDetailControllerTrait;

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
     * @param StoreBankAccountDetailRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBankAccountDetailRequest $request): RedirectResponse
    {
        return $this->traitStore($request);
    }

    /**
     * @param UpdateBankAccountDetailRequest $request
     * @param BankAccountDetail              $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function update(
        UpdateBankAccountDetailRequest $request,
        BankAccountDetail $bankAccountDetail
    ): RedirectResponse {
        return $this->traitUpdate($request, $bankAccountDetail);
    }

    /**
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function destroy(BankAccountDetail $bankAccountDetail): RedirectResponse
    {
        return $this->traitDestroy($bankAccountDetail);
    }

    /**
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function restore(BankAccountDetail $bankAccountDetail): RedirectResponse
    {
        return $this->traitRestore($bankAccountDetail);
    }
}
