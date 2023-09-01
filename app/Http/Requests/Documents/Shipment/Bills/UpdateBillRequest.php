<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;
use App\Models\Documents\Shipment\Bills\Bill;
use Illuminate\Validation\Validator;

class UpdateBillRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.update.fail';

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $billId = (int)$this->input('document_id');

        $validator->after(function ($validator) use ($billId) {
            if (Bill::find($billId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
        });

        parent::withValidator($validator);
    }
}
