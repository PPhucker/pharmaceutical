<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
                'required'
            ],
            'permissions' => [
                'required'
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'update.fail',
                    __('users.action.update.fail', ['name' => $this->input('name')])
                );
            }
        });
    }
}
