<?php

namespace App\Repositories\Admin\Organization;

use App\Models\Admin\Organization\BankAccountDetail;
use App\Repositories\Contractor\BankAccountDetailRepository as ContractorBankAccountDetailReposytory;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий банковских реквизитов организации.
 */
class BankAccountDetailRepository extends ContractorBankAccountDetailReposytory
{
    /**
     * @param array $validated
     *
     * @return BankAccountDetail
     */
    public function create(array $validated)
    {
        $paymentAccount = $validated['payment_account'][$validated['bank']];

        return $this->model->create(
            [
                'organization_id' => (int)$validated['organization_id'],
                'user_id' => Auth::user()->id,
                'bank' => $validated['bank'],
                'payment_account' => $paymentAccount,
            ]
        );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return BankAccountDetail::class;
    }
}
