<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Type\TypeOfEndProduct;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового типа готовой продукции.
 */
class StoreTypeOfEndProductRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.types_of_end_products';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'type_of_end_product.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
                'unique:classifier_types_of_end_products,name',
            ],
            $prefix . 'color' => [
                'nullable',
                'string',
                'max:7',
            ],
        ];
    }
}
