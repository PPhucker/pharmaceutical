<?php

namespace App\Http\Requests\Documents\Acts;

use App\Http\Requests\CoreFormRequest;

class StoreActRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.acts.actions.create.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organization_id' => [
                'required',
                'numeric',
            ],
            'contractor_id' => [
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
        ];
    }
}
