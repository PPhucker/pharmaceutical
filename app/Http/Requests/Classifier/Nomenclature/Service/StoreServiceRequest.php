<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Services;

use App\Http\Requests\CoreFormRequest;

class StoreServiceRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'classifiers.nomenclature.services.actions.create.fail';

    public function rules()
    {
        $prefix = 'service.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:255',
            ],
            $prefix . 'okei_code' => [
                'required',
                'string',
                'max:10',
            ],
        ];
    }
}
