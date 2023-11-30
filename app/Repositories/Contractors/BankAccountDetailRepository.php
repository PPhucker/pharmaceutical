<?php

namespace App\Repositories\Contractors;

use App\Models\Contractors\BankAccountDetail;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий банковских реквизитов контрагента.
 */
class BankAccountDetailRepository extends CrudRepository
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()->all();
    }

    /**
     * @param array $validated
     *
     * @return BankAccountDetail
     */
    public function create(array $validated): BankAccountDetail
    {
        $paymentAccount = $validated['payment_account'][$validated['bank']];

        return BankAccountDetail::create(
            [
                'contractor_id' => (int)$validated['contractor_id'],
                'user_id' => Auth::user()->id,
                'bank' => $validated['bank'],
                'payment_account' => $paymentAccount,
            ]
        );
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        foreach ($validated['bank_account_details'] as $account) {
            BankAccountDetail::withTrashed()
                ->findOrFail((int)$account['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'payment_account' => $account['payment_account'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return BankAccountDetail::class;
    }
}
