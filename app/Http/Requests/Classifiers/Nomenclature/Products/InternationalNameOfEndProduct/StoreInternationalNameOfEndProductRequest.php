<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\InternationalNameOfEndProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternationalNameOfEndProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'international_name_of_end_product.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max: 60',
                'unique:classifier_international_names_of_end_products,name'
            ],
        ];
    }
}
