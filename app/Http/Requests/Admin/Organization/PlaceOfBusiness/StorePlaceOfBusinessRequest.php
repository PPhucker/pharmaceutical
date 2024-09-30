<?php

namespace App\Http\Requests\Admin\Organization\PlaceOfBusiness;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления места осуществления деятельности организации.
 */
class StorePlaceOfBusinessRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'place_of_business.';

        return [
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'identifier' => [
                'nullable',
                'numeric',
                'digits:14',
                'distinct',
                'unique:organizations_places_of_business,identifier',
            ],
            $prefix . 'registered' => [
                'nullable',
                Rule::unique('organizations_places_of_business', 'registered')
                    ->where('organization_id', $this->input($prefix . 'organization_id'))
                    ->whereNull('deleted_at')
            ],
            $prefix . 'index' => [
                'required',
                'numeric',
                'digits:6',
            ],
            $prefix . 'address' => [
                'required',
                'string',
            ]
        ];
    }
}
