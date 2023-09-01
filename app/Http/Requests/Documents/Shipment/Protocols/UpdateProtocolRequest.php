<?php

namespace App\Http\Requests\Documents\Shipment\Protocols;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;
use App\Models\Documents\Shipment\Protocols\Protocol;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления протокола к отгрузке.
 */
class UpdateProtocolRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.protocols.actions.create.fail';

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $billId = (int)$this->input('document_id');

        $validator->after(function ($validator) use ($billId) {
            if (Protocol::find($billId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
        });

        parent::withValidator($validator);
    }
}
