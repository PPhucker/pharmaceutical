<?php

namespace App\Http\Requests\Contractor\Transport\Car;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления автомобиля контрагента
 */
class UpdateCarRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.cars';

    protected $action = 'update';

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
                    ->whereNotIn('state_number', $this->input($prefix . 'state_number'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
