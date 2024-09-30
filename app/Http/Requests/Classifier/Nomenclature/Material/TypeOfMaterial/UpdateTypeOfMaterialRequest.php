<?php

namespace App\Http\Requests\Classifier\Nomenclature\Material\TypeOfMaterial;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления типов комплектующих.
 */
class UpdateTypeOfMaterialRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'types_of_materials.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('classifier_types_of_materials', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name'))
            ],
        ];
    }
}
