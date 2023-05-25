<?php

namespace App\Http\Requests\Documents\Acts;

use App\Http\Requests\CoreFormRequest;

class IndexActRequest extends CoreFormRequest
{
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
        ];
    }
}
