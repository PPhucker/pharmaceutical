<?php

namespace App\Http\Requests\Contractors\PlacesOfBusiness;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления мест осуществления деятельности контрагента.
 */
class UpdatePlaceOfBusinessRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.places_of_business';

    protected $action = 'update';

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
}
