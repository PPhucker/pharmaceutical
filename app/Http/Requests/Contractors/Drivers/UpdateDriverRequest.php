<?php

namespace App\Http\Requests\Contractors\Drivers;

use App\Http\Requests\CoreFormRequest;

class UpdateDriverRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.drivers.actions.update.fail';
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'drivers.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
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
