<?php

namespace App\Http\Requests\Classifier\Region;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового региона.
 */
class StoreRegionRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'region.';

        return [
            $prefix . 'name' => [
                'required',
                'string',
                'max:120',
                'unique:classifier_regions,name',
            ],
            $prefix . 'zone' => [
                'nullable',
                'string',
                'unique:classifier_regions,zone',
            ],
        ];
    }
}
