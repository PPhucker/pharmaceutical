<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ApprovePackingListRequest extends FormRequest
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
            'filename' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:15000',
            ],
            'approved' => [
                'nullable',
                'boolean',
            ],
            'comment' => [
                'nullable',
                'string',
                'max:255',
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
