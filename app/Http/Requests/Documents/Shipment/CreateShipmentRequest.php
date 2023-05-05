<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

abstract class CreateShipmentRequest extends CoreFormRequest
{
    protected $key = '';

    /**
     * @var array[]
     */
    protected $rules = [
        'packing_list_id' => [
            'required',
            'numeric',
        ],
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'packing_list_id' => [
                'required',
                'numeric',
                Rule::unique(
                    'documents_shipment_' . $this->key,
                    'packing_list_id'
                )
                    ->whereNull('deleted_at'),
            ],
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'packing_list_id.unique' => __(
                'documents.shipment.' . $this->key . '.errors.packing_list_id.unique'
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
