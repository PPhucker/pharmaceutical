<?php

namespace App\Http\Requests\Classifier\Nomenclature\Material\TypeOfMaterial;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового типа комплектующего.
 */
class StoreTypeOfMaterialRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'type_of_material.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
                'unique:classifier_types_of_materials,name'
            ],
        ];
    }
}
