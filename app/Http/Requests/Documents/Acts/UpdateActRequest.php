<?php

namespace App\Http\Requests\Documents\Acts;

use App\Http\Requests\CoreFormRequest;

class UpdateActRequest extends CoreFormRequest
{

    protected $afterValidatorFailKeyMessage = 'documents.acts.actions.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => [
                'required',
                'string',
                'max:10',
            ],
            'date' => [
                'required',
                'date',
            ],
            'filename' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:15000',
            ],

        ];
    }
}
