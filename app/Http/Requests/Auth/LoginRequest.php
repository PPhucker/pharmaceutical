<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\CoreFormRequest;


/**
 * Валидация авторизации пользователя.
 */
class LoginRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'ends_with:' . config('mail.domain'),
                'max:60'
            ],
            'password' => [
                'required',
                'string',
            ],
            'organization' => [
                'required',
                'numeric',
            ],
        ];
    }
}
