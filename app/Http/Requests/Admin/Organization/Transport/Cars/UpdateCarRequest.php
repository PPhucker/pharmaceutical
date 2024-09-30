<?php

namespace App\Http\Requests\Admin\Organization\Transport\Cars;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления автомобилей организации.
 */
class UpdateCarRequest extends CoreFormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'cars.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'car_model' => [
                'required',
                'string',
                'max:20',
            ],
            $prefix . 'state_number' => [
                'required',
                'string',
                'max:15',
                Rule::unique('organizations_cars', 'state_number')
                    ->whereNotIn('state_number', $this->input($prefix . 'state_number'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
