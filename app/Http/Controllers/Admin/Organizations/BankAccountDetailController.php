<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organizations\BankAccountDetails\StoreBankAccountDetailRequest;
use App\Http\Requests\Admin\Organizations\BankAccountDetails\UpdateBankAccountDetailRequest;
use App\Models\Admin\Organizations\BankAccountDetail;
use App\Repositories\Admin\Organizations\BankAccountDetailRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BankAccountDetailController extends CoreController
{
    protected function getRepository()
    {
        return BankAccountDetailRepository::class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBankAccountDetailRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBankAccountDetailRequest $request)
    {
        $validated = $request->validated()['bank_account_detail'];

        $bankAccountDetail = BankAccountDetail::create(
            [
                'organization_id' => (int)$validated['organization_id'],
                'user_id' => Auth::user()->id,
                'bank' => $validated['bank'],
                'payment_account' => $validated['payment_account'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.bank_account_details.actions.create.success',
                    ['name' => $bankAccountDetail->payment_account]
                )
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankAccountDetailRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateBankAccountDetailRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['bank_account_details'] as $item) {
            $bankAccountDetail = BankAccountDetail::find((int)$item['id']);

            $bankAccountDetail->fill(
                [
                    'user_id' => Auth::user()->id,
                    'bank' => $item['bank'],
                    'payment_account' => $item['payment_account'],
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.bank_account_details.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function destroy(BankAccountDetail $bankAccountDetail)
    {
        $bankAccountDetail->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.bank_account_details.actions.destroy.success',
                    ['name' => $bankAccountDetail->payment_account]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function restore(BankAccountDetail $bankAccountDetail)
    {
        $bankAccountDetail->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.bank_account_details.actions.restore.success',
                    ['name' => $bankAccountDetail->payment_account]
                )
            );
    }

    protected function getPolicy()
    {
        // TODO: Implement getPolicy() method.
    }
}
