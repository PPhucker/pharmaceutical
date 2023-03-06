<?php

namespace App\Http\Requests\Contractors\BankAccountDetails;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateBankAccountDetailRequest extends FormRequest
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
        $prefix = 'bank_account_details.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'bank' => [
                'required',
                'numeric',
                'digits:9'
            ],
            $prefix . 'payment_account' => [
                'required',
                'numeric',
                'digits:20'
            ]
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('contractors.bank_account_details.actions.update.fail')
                );
            }
        });
    }
}
