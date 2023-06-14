<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class RedirectPackingListRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.packing_lists.errors.failed_document';

    public $rules = [
        'document' => [
            'required',
            'string',
            'max:20',
        ],
        'packing_list_id' => [
            'required',
            'numeric',
        ],
    ];

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'packing_list_id.required' => __(
                'documents.shipment.bills.errors.packing_list_id.required'
            ),
            'packing_list_id.unique' => __(
                'documents.shipment.bills.errors.packing_list_id.unique'
            ),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->rules['document'][] = Rule::in(
            [
                'bills',
                'protocols',
                'appendixes',
                'waybills',
            ]
        );

        return $this->rules;
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
                foreach ($validator->errors()->get('document') as $message) {
                    $validator->errors()->add(
                        'alert-errors',
                        $message
                    );
                }
                $validator->errors()->add('fail', __($this->afterValidatorFailKeyMessage));
            }
        });
    }
}
