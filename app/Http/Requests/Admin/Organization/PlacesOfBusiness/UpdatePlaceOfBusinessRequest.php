<?php

namespace App\Http\Requests\Admin\Organization\PlacesOfBusiness;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

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
