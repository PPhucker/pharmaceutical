<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления пользователя.
 */
class UpdateUserRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:60',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'ends_with:' . config('mail.domain'),
                'max:60',
                Rule::unique(
                    'users',
                    'email'
                )
                    ->whereNotIn(
                        'email',
                        [$this->input('email')]
                    )
                    ->whereNull('deleted_at'),
            ],

            'roles' => [
                'nullable',
                'array',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'organizations' => [
                'nullable',
                'array',
            ],
        ];
    }
}
