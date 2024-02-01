<?php

namespace App\Traits\Contractor\Controller;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Трейт для работы с банковскими реквизитами.
 */
trait BankAccountDetailControllerTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest $request
     *
     * @return RedirectResponse
     */
    public function traitStore($request): RedirectResponse
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
     * @param FormRequest $request
     * @param Model       $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function traitUpdate(
        $request,
        $bankAccountDetail
    ): RedirectResponse {
        $validated = $request->validated();

        $this->service->update($bankAccountDetail, $validated);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function traitDestroy($bankAccountDetail): RedirectResponse
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
     * @param Model $bankAccountDetail
     *
     * @return RedirectResponse
     */
    public function traitRestore($bankAccountDetail): RedirectResponse
    {
        $this->service->restore($bankAccountDetail);

        return $this->successRedirect(
            'restore',
            ['name' => $bankAccountDetail->payment_account]
        );
    }
}
