<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * Базовый класс валидации.
 */
abstract class CoreFormRequest extends FormRequest
{

    protected $afterValidatorFailKeyMessage;

    protected $rules = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return $this->rules;
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __($this->afterValidatorFailKeyMessage)
                );
            }
        });
    }
}
