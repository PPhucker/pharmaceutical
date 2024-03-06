<?php

namespace App\Http\Requests\Contractor\ContactPerson;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления крнтактного лица контрагента.
 */
class StoreContactPersonRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'contact_person.';

        return [
            $prefix . 'contractor_id' => [
                'required',
                'numeric',
            ],

            $prefix . 'name' => [
                'required',
                'string',
                'max:50',
            ],
            $prefix . 'post' => [
                'nullable',
                'string',
                'max:50',
            ],
            $prefix . 'phone' => [
                'nullable',
                'string',
                'max: 60',
            ],
            $prefix . 'email' => [
                'nullable',
                'email',
            ],
        ];
    }
}
