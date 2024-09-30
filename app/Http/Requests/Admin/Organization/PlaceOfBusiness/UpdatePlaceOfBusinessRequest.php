<?php

namespace App\Http\Requests\Admin\Organization\PlaceOfBusiness;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления мест осуществления деятельности организации.
 */
class UpdatePlaceOfBusinessRequest extends CoreFormRequest
{
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
            $prefix . 'organization_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'identifier' => [
                'nullable',
                'numeric',
                'digits:14',
                'distinct',
                Rule::unique('organizations_places_of_business', 'identifier')
                    ->whereNotIn('identifier', $this->input($prefix . 'identifier'))
                    ->whereNull('deleted_at'),
            ],
            $prefix . 'index' => [
                'required',
                'numeric',
                'digits:6'
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
}
