<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Material;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления комплектующего в состав продукта из каталога.
 */
class AttachMaterialRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'material.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],
        ];
    }
}
