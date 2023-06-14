<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:60'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'ends_with:' . config('mail.domain'),
                'max:60',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],

            'password' => [
                'required',
                'string',
                'min:8'
            ],

            'roles' => [
                'nullable'
            ],
            'permissions' => [
                'nullable'
            ],
        ];
    }
}
