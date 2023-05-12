<?php

namespace App\Http\Requests\Contractors\Trailers;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

class UpdateTrailerRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'contractors.trailers.actions.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'trailers.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
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
                    ->whereNotIn('state_number', $this->input($prefix . 'state_number'))
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
