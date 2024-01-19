<?php

namespace App\Http\Requests\Contractor\Transport\Car;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления автомобиля контрагента.
 */
class StoreCarRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.cars';

    protected $action = 'create';

    /**
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'car.';

        return [
            $prefix . 'contractor_id' => [
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
                Rule::unique('contractors_cars', 'state_number')
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
