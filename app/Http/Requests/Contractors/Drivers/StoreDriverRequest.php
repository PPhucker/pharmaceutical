<?php

namespace App\Http\Requests\Contractors\Drivers;

use App\Http\Requests\CoreFormRequest;

class StoreDriverRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.drivers.actions.create.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'driver.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:60',
            ],
        ];
    }
}
