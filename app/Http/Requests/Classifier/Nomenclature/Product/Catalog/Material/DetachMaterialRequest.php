<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\Material;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация открепления комплектующего от продукта из каталога.
 */
class DetachMaterialRequest extends CoreFormRequest
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
                'numeric',
            ],
        ];
    }
}
