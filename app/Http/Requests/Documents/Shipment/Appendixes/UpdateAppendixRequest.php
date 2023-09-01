<?php

namespace App\Http\Requests\Documents\Shipment\Appendixes;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;
use App\Models\Documents\Shipment\Appendixes\Appendix;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления приложения к отгрузке.
 */
class UpdateAppendixRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.appendixes.actions.update.fail';

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $billId = (int)$this->input('document_id');

        $validator->after(function ($validator) use ($billId) {
            if (Appendix::find($billId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
        });

        parent::withValidator($validator);
    }
}
