<?php

namespace App\Http\Requests\Contractors\PlacesOfBusiness;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления мест осуществления деятельности контрагента.
 */
class UpdatePlaceOfBusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'places_of_business.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'identifier' => [
                'nullable',
                'numeric',
                'digits:14',
                'distinct',
                Rule::unique('contractors_places_of_business', 'identifier')
                    ->whereNotIn('identifier', $this->input($prefix . 'identifier'))
                    ->whereNull('deleted_at'),
            ],
            $prefix . 'index' => [
                'required',
                'numeric',
                'digits:6'
            ],
            $prefix . 'region_id' => [
                'nullable',
                'numeric',
            ],
            $prefix . 'address' => [
                'required',
                'string'
            ],
            'registered' => [
                'nullable'
            ],
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __(
                        'contractors.places_of_business.actions.update.fail',
                        ['name' => $this->address]
                    )
                );
            }
        });
    }
}
