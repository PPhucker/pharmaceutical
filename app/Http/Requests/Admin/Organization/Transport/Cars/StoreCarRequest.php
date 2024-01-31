<?php

namespace App\Http\Requests\Admin\Organization\Transport\Cars;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class StoreCarRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.cars.actions.create.fail';

    public function rules()
    {
        $prefix = 'car.';

        return [
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
                    ->where('organization_id', $this->input($prefix . 'organization_id'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
