<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use Illuminate\Foundation\Http\FormRequest;

class IndexPackingListRequest extends FormRequest
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
            'organization_id' => [
                'nullable',
                'numeric',
            ],
            'fromDate' => [
                'nullable',
                'date',
            ],
            'toDate' => [
                'nullable',
                'date',
            ],
            'choice' => [
                'nullable',
                'numeric',
            ],
        ];
    }
}
