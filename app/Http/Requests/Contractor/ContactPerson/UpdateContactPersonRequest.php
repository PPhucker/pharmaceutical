<?php

namespace App\Http\Requests\Contractor\ContactPerson;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация обновления контактного лица контрагента.
 */
class UpdateContactPersonRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'contractors.contact_persons';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'contact_persons.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric'
            ],

            $prefix . 'name' => [
                'required',
                'string',
                'max:50'
            ],
            $prefix . 'post' => [
                'nullable',
                'string',
                'max:50',
            ],
            $prefix . 'phone' => [
                'nullable',
                'string',
                'max: 60'
            ],
            $prefix . 'email' => [
                'nullable',
                'email',
            ],
        ];
    }
}
