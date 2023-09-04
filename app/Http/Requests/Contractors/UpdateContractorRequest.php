<?php

namespace App\Http\Requests\Contractors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления контрагента.
 */
class UpdateContractorRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'legal_form_type' => [
                'required',
                'string',
                'max:15'
            ],
            'name' => [
                'required',
                'string',
                'max:120'
            ],
            'INN' => [
                'required',
                'numeric',
                'digits_between:10,12',
                Rule::unique('contractors', 'INN')
                    ->ignore($this->input('id')),
            ],
            'OKPO' => [
                'required',
                'numeric',
                'digits_between:8,10',
                Rule::unique('contractors', 'OKPO')
                    ->ignore($this->input('id'))
            ],
            'kpp' => [
                'required',
                'numeric',
                'digits:9',
            ],
            'contacts' => [
                'nullable',
                'string',
                'max:120'
            ],
            'comment' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'contractors.actions.update.fail',
                    __('fail', ['name' => $this->name])
                );
            }
        });
    }
}
