<?php

namespace App\Http\Requests\Classifier\Bank;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления классфикатора банков.
 */
class UpdateBankRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.banks';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'banks.*.';

        return [
            $prefix . 'original_BIC' => [
                'required',
                'string'
            ],
            $prefix . 'BIC' => [
                'required',
                'numeric',
                'digits: 9',
                'distinct',
                Rule::unique('classifier_banks', 'BIC')
                    ->whereNotIn('BIC', $this->input($prefix . 'BIC'))
            ],
            $prefix . 'correspondent_account' => [
                'required',
                'numeric',
                'digits: 20'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max: 120'
            ],
        ];
    }
}
