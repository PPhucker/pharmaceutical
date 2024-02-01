<?php

namespace App\Http\Requests\Contractor\PlaceOfBusiness;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class StorePlaceOfBusinessRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.places_of_business';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'place_of_business.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'identifier' => [
                'nullable',
                'numeric',
                'digits:14',
                'distinct',
                'unique:contractors_places_of_business,identifier',
            ],
            $prefix . 'registered' => [
                'nullable',
                Rule::unique('contractors_places_of_business', 'registered')
                    ->where('contractor_id', $this->input($prefix . 'contractor_id'))
                    ->whereNull('deleted_at')
            ],
            $prefix . 'index' => [
                'required',
                'numeric',
                'digits:6'
            ],
            $prefix . 'address' => [
                'required',
                'string'
            ]
        ];
    }
}
