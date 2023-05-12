<?php

namespace App\Http\Requests\Contractors\Cars;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class UpdateCarRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.cars.actions.update.fail';

    public function rules()
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