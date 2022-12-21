<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'ends_with:' . env('CORPORATE_MAIL_DOMAIN'),
                'max:60'
            ],

            'password' => [
                'required',
                'string',
            ]
        ];
    }
}
