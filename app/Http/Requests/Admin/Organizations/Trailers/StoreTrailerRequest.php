<?php

namespace App\Http\Requests\Admin\Organizations\Trailers;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class StoreTrailerRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.trailers.actions.create.fail';

    public function rules()
    {
        $prefix = 'trailer.';

        return [
            $prefix . 'organization_id' => [
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
                Rule::unique('organizations_trailers', 'state_number')
                    ->where('organization_id', $this->input($prefix . 'organization_id'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
