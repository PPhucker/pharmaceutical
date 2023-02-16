<?php

namespace App\Http\Requests\Admin\Organizations\PlacesOfBusiness;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StorePlaceOfBusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
                'digits:6'
            ],
            $prefix . 'address' => [
                'required',
                'string'
            ]
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __(
                        'contractors.places_of_business.actions.create.fail',
                        ['name' => $this->address]
                    )
                );
            }
        });
    }
}
