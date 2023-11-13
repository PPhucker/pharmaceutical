<?php

namespace App\Http\Requests\Classifiers\Region;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления нового региона.
 */
class StoreRegionRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'classifiers.regions.actions.create.fail';

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
            ],
            $prefix . 'zone' => [
                'nullable',
                'string',
            ],
        ];
    }
}
