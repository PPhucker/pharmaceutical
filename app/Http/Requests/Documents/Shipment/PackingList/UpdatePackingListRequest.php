<?php

namespace App\Http\Requests\Documents\Shipment\PackingList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdatePackingListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'packing_list_id' => [
                'required',
                'numeric',
            ],
            'organization_place_id' => [
                'required',
                'numeric',
            ],
            'organization_bank_id' => [
                'required',
                'numeric',
            ],
            'contractor_place_id' => [
                'required',
                'numeric',
            ],
            'contractor_bank_id' => [
                'required',
                'numeric',
            ],
            'number' => [
                'required',
                'string',
                'max:10',
            ],
            'date' => [
                'required',
                'date',
            ],
            'director' => [
                'nullable',
                'string',
                'max:60',
            ],
            'bookkeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
            'storekeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
            'filename' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:15000',
            ],
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
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.packing_lists.actions.update.fail')
                );
            }
        });
    }
}
