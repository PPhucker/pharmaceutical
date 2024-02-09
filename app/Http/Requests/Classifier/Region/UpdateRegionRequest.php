<?php

namespace App\Http\Requests\Classifiers\Region;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления регионов.
 */
class UpdateRegionRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'classifiers.regions.actions.update.fail';

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
            ],
        ];
    }
}
