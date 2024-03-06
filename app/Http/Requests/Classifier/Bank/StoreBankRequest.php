<?php

namespace App\Http\Requests\Classifier\Bank;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового банка в классифкатор.
 */
class StoreBankRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'bank.';

        return [
            $prefix . 'BIC' => [
                'required',
                'numeric',
                'digits: 9',
                'unique:classifier_banks,BIC',
            ],
            $prefix . 'correspondent_account' => [
                'required',
                'numeric',
                'digits: 20',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max: 120',
            ],
        ];
    }
}
