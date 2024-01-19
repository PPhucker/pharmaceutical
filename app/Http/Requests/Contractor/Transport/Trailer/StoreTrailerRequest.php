<?php

namespace App\Http\Requests\Contractor\Transport\Trailer;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления прицепа контрагента.
 */
class StoreTrailerRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.trailers';

    protected $action = 'create';

    /**
     * @return array
     */
    public function rules(): array
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
