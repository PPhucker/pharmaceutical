<?php

namespace App\Http\Requests\Classifier\Region;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления регионов.
 */
class UpdateRegionRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'regions.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:120',
                Rule::unique('classifier_regions', 'name')
                    ->whereNotIn('name', $this->input($prefix . 'name'))
            ],
            $prefix . 'zone' => [
                'nullable',
                'string',
                Rule::unique('classifier_regions', 'zone')
                    ->whereNotIn('zone', $this->input($prefix . 'zone'))
            ],
        ];
    }
}
