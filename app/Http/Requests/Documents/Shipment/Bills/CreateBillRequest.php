<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CreateBillRequest extends CreateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.create.fail';

    /**
     * @return array
     */
    public function rules()
    {
        $this->rules['packing_list_id'][] = Rule::unique(
            'documents_shipment_bills',
            'packing_list_id'
        )
            ->whereNull('deleted_at');

        return $this->rules;
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'packing_list_id.unique' => __(
                'documents.shipment.bills.errors.packing_list_id.unique'
            ),
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                foreach ($validator->errors()->get('packing_list_id') as $message) {
                    $validator->errors()->add(
                        'alert-errors',
                        $message
                    );
                }
                $validator->errors()->add(
                    'fail',
                    __($this->afterValidatorFailKeyMessage)
                );
            }
        });
    }
}
