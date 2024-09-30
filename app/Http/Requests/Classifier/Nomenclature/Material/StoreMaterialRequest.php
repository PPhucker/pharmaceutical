<?php

namespace App\Http\Requests\Classifier\Nomenclature\Material;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового комплектующего.
 */
class StoreMaterialRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type_id' => [
                'required',
                'numeric',
            ],
            'okei_code' => [
                'required',
                'string',
                'max:10',
            ],
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'price' => [
                'numeric',
                'nullable',
            ],
            'nds' => [
                'numeric',
                'nullable',
                'max:100',
            ],
        ];
    }
}
