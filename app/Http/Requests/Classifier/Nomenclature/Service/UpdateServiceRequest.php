<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Services;

use App\Http\Requests\CoreFormRequest;

class UpdateServiceRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'classifiers.nomenclature.services.actions.update.fail';

    public function rules()
    {
        $prefix = 'services.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
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
