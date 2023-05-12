<?php

namespace App\Http\Requests\Contractors\Trailers;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class StoreTrailerRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.trailers.actions.create.fail';

    public function rules()
    {
        $prefix = 'trailer.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'type' => [
                'required',
                'string',
                'max:5',
            ],
            $prefix . 'state_number' => [
                'required',
                'string',
                'max:15',
                Rule::unique('contractors_trailers', 'state_number')
                    ->where('contractor_id', $this->input($prefix . 'contractor_id'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
