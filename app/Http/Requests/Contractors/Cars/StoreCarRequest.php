<?php

namespace App\Http\Requests\Contractors\Cars;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class StoreCarRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.cars.actions.create.fail';

    public function rules()
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
